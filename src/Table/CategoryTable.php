<?php
namespace App\Table;
use \PDO;
use App\Model\Category;
use App\Table\Exception\NotFoundException;

class CategoryTable extends Table {
    
    protected $table = "category";
    protected $class = Category::class;
    protected $id = id_category;
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
            )->fetchAll(PDO::FETCH_CLASS, $this->class);
        
        foreach($categories as $category) {
            $postsByID[$category->getPostID()]->addCategory($category);
        }
    }

    public function delete(int $id) {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_category = ?");
        $ok = $query->execute([$id]);
        if ($ok === false) {
            throw new \Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }
    }

    public function create(Category $category) {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET name_category = :name, slug_category = :slug ");
        $ok = $query->execute([
            'name' => $category->getName(),
            'slug' => $category->getSlug()
        ]);
        if ($ok === false) {
            throw new \Exception("Impossible de créer l'enregistrement dans la table {$this->table}");
        }
        $category->setID($this->pdo->lastInsertId());
    }

    public function update(Category $category) {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name_category = :name, slug_category = :slug WHERE id_category =:id");
        $ok = $query->execute([
            'id' => $category->getID(),
            'name' => $category->getName(),
            'slug' => $category->getSlug()
        ]);
        if ($ok === false) {
            throw new \Exception("Impossible de modifier l'enregistrement $id dans la table {$this->table}");
        }
    }

}