<?php
namespace App\Validators;

use App\Table\PostTable;

class PostValidator extends AbstractValidator {

    public function __construct(array $data, PostTable $table, ?int $postID = null) {
        parent::__construct($data);
        $this->validator->rule('required', ['title','slug']);
        $this->validator->rule('lengthBetween', ['title','slug'], 5, 100);
        $this->validator->rule('slug', 'slug');
        //règle pour éviter les doublons de slug dans la bdd___A revoir
        /*
        $this->validator->rule(function($field, $value) use ($table, $postID) {
            $field = 'slug_post';
            return !$table->exists($field, $value, $postID);
        },['slug'], 'Cette valeur est déjà utilisée');
        */
    }

}