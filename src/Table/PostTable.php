<?php
namespace App\Table;

use App\Paginated;
use App\Model\Post;
use App\Model\Category;
use \PDO;

class PostTable extends Table {

    protected $table = "post";
    protected $class = Post::class;
    protected $id = id_post;

    public function delete(int $id): void {
    $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_post = :id");
    $ok = $query->execute([$id]);
    if ($ok === false) {
        throw new \Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
    }
    }

    public function findPaginated() {
        // Recupère tous les articles paginées
        $paginated = new Paginated(
            "SELECT * FROM post ORDER BY created_at DESC",
            "SELECT COUNT(id_post) FROM {$this->table}",
            $this->pdo
        );
        $posts = $paginated->getItems(Post :: class);
        // recuperer les catégories liées aux articles  
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts,$paginated];
    }

    public function findPaginatedForCategory(int $categoryID) {

        $paginated = new Paginated(
            "SELECT p.* 
            FROM post p
            JOIN post_category pc ON pc.id_post = p.id_post
            WHERE pc.id_category = {$categoryID}
            ORDER BY created_at DESC",
            "SELECT COUNT(id_category) FROM post_category WHERE id_category = {$categoryID} "
        );
        $posts = $paginated->getItems(Post::class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return [$posts,$paginated];
        
    }

}