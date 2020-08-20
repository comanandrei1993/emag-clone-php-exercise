<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 16-Aug-20
 * Time: 11:47 AM
 */
class Favorite extends BaseTable {
    public $id;

    public $user_id;

    public $product_id;

    /**
     * Review constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->id = $data['id'];

        $this->user_id = $data['user_id'];

        $this->product_id = $data['product_id'];
    }

    public function getTable() {
        return 'favorites';
    }

    public function getProduct() {
        return Product::find($this->product_id);
    }
}