<?php
namespace App\Model;

class Category {

    private $id_category;

    private $name_category;

    private $slug_category;


    public function getID(): ?int {
        return $this->id_category;
    }

    public function getName(): ?string {
        return $this->name_category;
    }

    public function getSlug(): ?string {
        return $this->slug_category;
    }
}