<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 20-Aug-20
 * Time: 10:53 AM
 */
class ProductBrand extends BaseTable {
    public $id;

    public $brand_name;

    public function __construct($data) {
        $this->id = $data['id'];

        $this->brand_name = $data['brand_name'];
    }

    public function getTable() {
        return 'productBrands';
    }
}