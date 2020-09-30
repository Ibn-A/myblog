<?php
namespace App\Table;
use \PDO;
use App\Model\Category;
use App\Table\Exception\NotFoundException;

class CategoryTable extends Table {
    
    public function find(int $id): Category {

        $query = $this->pdo->prepare('SELECT * FROM category WHERE id_category = :id');
        $query->execute(['id' => $id ]);
        $query->setFetchMode(PDO::FETCH_CLASS, Category::class);
        /** @var Category|false */
        $category = $query->fetch();
        if ($category === false) {
            throw new NotFoundException('category', $id);
        }
        return $category;
    }

    /**
     * @param App\Model\Post[] $posts
     */
    public function hydratePosts(array $posts): void {

        $postsByID = [];
        foreach($posts as $post) {
            $postsByID[$post->getID()] = $post;
        }
        $categories = $this->pdo->query('SELECT c.*, pc.id_post 
                    FROM post_category pc 
                    JOIN category c ON c.id_category = pc.id_category 
                    WHERE pc.id_post IN(' . implode(',', array_keys($postsByID)) . ')'
            )->fetchAll(PDO::FETCH_CLASS, Category::class);
        
        foreach($categories as $category) {
            $postsByID[$category->getPostID()]->addCategory($category);
        }
    }

}