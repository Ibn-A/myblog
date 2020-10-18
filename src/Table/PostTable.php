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


    public function createPost(Post $post): void {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET title = :title, slug_post = :slug, content = :content, created_at = :created, id_user = 1");
        $ok = $query->execute([
            'title' => $post->getTitle(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created' => $post->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
        $post->setID($this->pdo->lastInsertId());
        if ($ok === false) {
            throw new \Exception("Impossible de créer l'enregistrement dans la table {$this->table}");
        }
        
    }

    public function attachCategories(int $id, array $categories) {
        $this->pdo->exec("DELETE FROM post_category WHERE id_post = ". $id);
        $query = $this->pdo->prepare("INSERT INTO post_category SET id_post = ?, id_category = ?");
        foreach($categories as $category) {
            $query->execute([$id, $category]);
        }
    }

    public function updatePost(Post $post): void {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET title = :title, slug_post = :slug, content = :content, created_at = :created WHERE id_post =:id");
        $ok = $query->execute([
            'id' => $post->getID(),
            'title' => $post->getTitle(),
            'slug' => $post->getSlug(),
            'content' => $post->getContent(),
            'created' => $post->getCreatedAt()->format('Y-m-d H:i:s')
        ]);

        if ($ok === false) {
            throw new \Exception("Impossible de modifier l'enregistrement $id dans la table {$this->table}");
        }
    }

    public function deletePost(int $id): void {
    $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_post = ?");
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