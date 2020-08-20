<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 16-Aug-20
 * Time: 12:42 PM
 */
class ProductSubcategory extends BaseTable {
    public $id;

    public $catId;

    public $subcatName;

    /**
     * ProductCategory constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->id = $data['id'];

        $this->catId = $data['catId'];

        $this->subcatName = $data['subcatName'];
    }

    public function getTable() {
        return 'prodSubCats';
    }

    public function getProducts() {
        return Product::findBy(['subcategory' => $this->id]);
    }
}