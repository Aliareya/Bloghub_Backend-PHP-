<?php
namespace App\Core;

class Validator {
    private array $errors = [];

    private array $rules = [
        'name'             => 'required|string|min:3|max:50',
        'email'            => 'required|email',
        'username'         => 'required|string|min:3|max:30',
        'password'         => 'required|string|min:6|max:100',
        'confirm_password' => 'required|string|match:password',
        'role'             => 'required|string',
    ];

    public function validate(array $data): bool {
        foreach ($this->rules as $field => $ruleStr) {
            $rulesArr = array_map('trim', explode('|', $ruleStr));
            $value = trim($data[$field] ?? '');

            foreach ($rulesArr as $rule) {
                // Required
                if ($rule === 'required' && $value === '') {
                    $this->errors[] = "The $field field is required.";
                    break 2; // stop both loops immediately
                }

                // Email validation
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[] = "The $field field must be a valid email address.";
                    break 2;
                }

                // String validation
                if ($rule === 'string' && !is_string($value)) {
                    $this->errors[] = "The $field field must be a string.";
                    break 2;
                }

                // Minimum length
                if (str_starts_with($rule, 'min:')) {
                    $min = (int)substr($rule, 4);
                    if (strlen($value) < $min) {
                        $this->errors[] = "The $field field must be at least $min characters long.";
                        break 2;
                    }
                }

                // Maximum length
                if (str_starts_with($rule, 'max:')) {
                    $max = (int)substr($rule, 4);
                    if (strlen($value) > $max) {
                        $this->errors[] = "The $field field must not exceed $max characters.";
                        break 2;
                    }
                }

                // Match another field
                if (str_starts_with($rule, 'match:')) {
                    $matchField = substr($rule, 6);
                    if (($data[$matchField] ?? '') !== $value) {
                        $this->errors[] = "Passwords do not match.";
                        break 2;
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function errors() {
        return $this->errors[0];
    }
}
