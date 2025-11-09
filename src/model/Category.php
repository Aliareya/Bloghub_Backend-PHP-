<?php
namespace App\model;

class Category {
    private ?int $id = null;
    private $name;
    private $slug;
    private $description;
    private $repoCategory;

    public function __construct(?int $id = null, $name, $slug, $description , $repoCategory){
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->repoCategory = $repoCategory;
    }



}