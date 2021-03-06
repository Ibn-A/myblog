<?php
namespace App\Validators;

use App\Table\CategoryTable;

class CategoryValidator extends AbstractValidator {

    public function __construct(array $data, CategoryTable $table, ?int $id = null) {
        parent::__construct($data);
        $this->validator->rule('required', ['name','slug']);
        $this->validator->rule('lengthBetween', ['name','slug'], 3, 100);
        $this->validator->rule('slug', 'slug');
        //règle pour éviter les doublons de slug dans la bdd___A revoir
        /*
        $this->validator->rule(function($field, $value) use ($table, $postID) {
            $field = 'slug_post';
            return !$table->exists($field, $value, $id);
        },['slug', 'name'], 'Cette valeur est déjà utilisée');
        */
    }

}