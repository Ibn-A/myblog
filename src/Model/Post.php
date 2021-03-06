<?php
namespace App\Model;

use App\Helpers\Text;
use \DateTime;

class Post {
    private $id_post;

    private $title;

    private $slug_post;

    private $content;

    private $created_at;

    private $categories = [];

    public function getID(): ?int {
        return $this->id_post;
    }

    public function setID(int $id):self {
        $this->id_post = $id;
        return $this;

    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    public function getSlug(): ?string {
        return $this->slug_post;
    }

    public function setSlug(string $slug): self {
        $this->slug_post = $slug;
        return $this;
    }

    public function getContent(): ?string {
        return nl2br(htmlentities($this->content));
    }

    public function setContent(string $content):self {
        $this->content = $content;
        return $this;
    }

    public function getCreatedAt(): Datetime {
        return new DateTime($this->created_at);
    }

    public function setCreatedAt(string $date): self {
        $this->created_at = $date;
        return $this;
    }
    /**
     * @return Category[]
     */
    public function getCategories(): array {
        return $this->categories;
    }

    public function setCategories(array $categories): self {
        $this->categories = $categories;
        return $this;
    }

    public function getExcerpt() {
        if ($this->content === null) {
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }

    public function getCategoriesIds() {
        $ids = [];
        Foreach($this->categories as $category) {
            $ids[] = $category->getID();
        }
        return $ids;
    }
    public function addCategory(Category $category): void {
        $this->categories[] = $category;
    }
}