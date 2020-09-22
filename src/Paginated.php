<?php
namespace App;
use App\Model\Post;

use \PDO;

class Paginated {

    private $query;
    private $queryCount;
    private $pdo;
    private $perPage;
    private $count;

    public function __construct(string $query, string $queryCount, ?\PDO $pdo = null, $perPage = 12) {

        $this->query = $query;
        $this->queryCount = $queryCount;
        $this->pdo = $pdo ?: Connection::getPDO();
        $this->perPage = $perPage;
     
    }

    public function getItems(string $classMapping): array {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if ($currentPage > $pages) {
            throw new \Exception('Cette page n\'existe pas');
        }
        //récupère les 12 dernières articles triés par date
        $offset = $this->perPage * ($currentPage - 1);
        $query = $this->pdo->query($this->query . " LIMIT {$this->perPage} OFFSET $offset ");
        $posts = $query->fetchAll(PDO::FETCH_CLASS, $classMapping);
        return $posts;
    }
    public function previousLink(string $link): ?string {
        $currentPage = $this->getCurrentPage();
        if ($currentPage <= 1) return null;
        if ($currentPage > 2) $link .= "?page=" . ($currentPage -1);
        return <<< HTML
            <a href="{$link}" class="btn btn-primary">&laquo; Page précédente</a>
HTML;
    }
/**
 * 
 */
    public function nextLink(string $link): ?string {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages ();
        if ($currentPage >= $pages) return null;
        $link .= "?page=" . ($currentPage + 1);
        return <<< HTML
            <a href="{$link}" class="btn btn-primary ml-auto"> Page suivante &raquo;</a>
HTML;
    }

    private function getCurrentPage():int {
        return URL::getPositiveInt('page', 1);
    }
    private function getPages(): int {
        if ($this->count === null) {
            $this->count = (int)$this->pdo
                ->query($this->queryCount)
                ->fetch(PDO::FETCH_NUM)[0];
        }
        //récupère le nombre total de pages
        return ceil($this->count / $this->perPage);
    }
}