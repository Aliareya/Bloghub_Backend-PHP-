<?php
namespace App\Core;

class Validator {
    private array $errors = [];

    // Define rules for all fields
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
                    $this->errors[$field][] = "فیلد $field الزامی است.";
                }

                // Email validation
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = "فیلد $field باید یک ایمیل معتبر باشد.";
                }

                // String validation
                if ($rule === 'string' && !is_string($value)) {
                    $this->errors[$field][] = "فیلد $field باید رشته باشد.";
                }

                // Minimum length
                if (str_starts_with($rule, 'min:')) {
                    $min = (int)substr($rule, 4);
                    if (strlen($value) < $min) {
                        $this->errors[$field][] = "فیلد $field باید حداقل $min کاراکتر باشد.";
                    }
                }

                // Maximum length
                if (str_starts_with($rule, 'max:')) {
                    $max = (int)substr($rule, 4);
                    if (strlen($value) > $max) {
                        $this->errors[$field][] = "فیلد $field نباید بیشتر از $max کاراکتر باشد.";
                    }
                }

                // Match another field
                if (str_starts_with($rule, 'match:')) {
                    $matchField = substr($rule, 6);
                    if (($data[$matchField] ?? '') !== $value) {
                        $this->errors[$field][] = "فیلد $field باید با $matchField مطابقت داشته باشد.";
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array {
        return $this->errors;
    }
}
