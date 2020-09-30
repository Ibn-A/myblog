<?php
namespace App\Table;

use App\Paginated;
use App\Model\Post;
use App\Model\Category;
use \PDO;

class PostTable {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findPaginated() {
        // Recupère tous les articles paginées
        $paginated = new Paginated(
            "SELECT * FROM post ORDER BY created_at DESC",
            "SELECT COUNT(id_post) FROM post",
            $this->pdo
        );
        $posts = $paginated->getItems(Post :: class);
        // recuperer les catégories liées aux articles  
        $postsByID = [];
        foreach($posts as $post) {
            $postsByID[$post->getID()] = $post;
        }

        $categories = $this->pdo->query('SELECT c.*, pc.id_post 
                    FROM post_category pc 
                    JOIN category c ON c.id_category = pc.id_category 
                    WHERE pc.id_post IN(' . implode(',', array_keys($postsByID)) . ')'
            )->fetchAll(PDO::FETCH_CLASS, Category::class);
        //On parcourt les catégories
        foreach($categories as $category) {
            $postsByID[$category->getPostID()]->addCategory($category);
        }
        return [$posts,$paginated];
    }
}