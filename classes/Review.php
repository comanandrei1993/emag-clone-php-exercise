<?php

class Review extends BaseTable {
    public $id;

    public $product_id;

    public $author;

    public $comment;

    public $score;

    /**
     * Review constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->id = $data['id'];

        $this->product_id = $data['product_id'];

        $this->author = $data['author'];

        $this->comment = $data['comment'];

        $this->score = $data['score'];
    }

    public function getTable() {
        return 'reviews';
    }
}