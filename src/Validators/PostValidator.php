<?php
namespace App\Validators;

use App\Validator;
use App\Table\PostTable;

class PostValidator {

    private $data;
    private $validator;

    public function __construct(array $data, PostTable $table, ?int $postID = null) {
        $this->data = $data;
        $v = new Validator($data);
        $v->rule('required', ['title','slug']);
        $v->rule('lengthBetween', ['title','slug'], 5, 100);
        $v->rule('slug', 'slug');
        //règle pour éviter les doublons de slug dans la bdd___A revoir
        /*
        $v->rule(function($field, $value) use ($table, $postID) {
            $field ='slug_post';
            return !$table->exists($field, $value, $postID);
        },['slug'], 'Cette valeur est déjà utilisée');
        */
        $this->validator = $v;
    }

    public function validate(): bool {
        return $this->validator->validate();
    }

    public function errors(): array {
        return $this->validator->errors();
    }
}