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

    private $categories;

    public function getID(): ?int {
        return $this->id_post;
    }
    public function getTitle(): ?string {
        return $this->title;
    }
    public function getSlug(): ?string {
        return $this->slug_post;
    }

    public function getContent(): ?string {
        return nl2br(htmlentities($this->content));
    }
    public function getCreatedAt(): Datetime {
        return new DateTime($this->created_at);
    }
    public function getCategories() {
        return $this->categories;
    }

    public function getExcerpt() {
        if ($this->content === null) {
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 60)));
    }
}