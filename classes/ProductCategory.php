<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 16-Aug-20
 * Time: 11:55 AM
 */
class ProductCategory extends BaseTable {
    public $id;

    public $catName;

    /**
     * ProductCategory constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->id = $data['id'];

        $this->catName = $data['catName'];
    }

    public function getTable() {
        return 'productCategories';
    }
}