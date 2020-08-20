<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 19-Aug-20
 * Time: 11:46 AM
 */
class Picture extends BaseTable {
    public $id;

    public $product_id;

    public $picture;

    public function __construct($data) {
        $this->id = $data['id'];

        $this->product_id = $data['product_id'];

        $this->picture = $data['picture'];
    }

    public function getTable() {
        return 'pictures';
    }
}