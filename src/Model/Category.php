<?php
namespace App\Model;

class Category {

    private $id_category;

    private $name_category;

    private $slug_category;

    private $id_post;


    public function getID(): ?int {
        return $this->id_category;
    }

    public function setID(int $id): self {
        $this->id_category = $id;
        return $this;
    }

    public function getName(): ?string {
        return $this->name_category;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): ?string {
        return $this->slug_category;
    }

    public function setSlug($slug): self {
        $this->slug_category = $slug;
        return $this;
    }

    public function getPostID(): ?int {
        return $this->id_post;
    }
}