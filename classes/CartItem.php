<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 17-Aug-20
 * Time: 1:27 PM
 */
class CartItem extends BaseTable {
    public $id;

    public $cart_id;

    public $prod_id;

    public $qty;

    /**
     * Review constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->id = $data['id'];

        $this->cart_id = $data['cart_id'];

        $this->prod_id = $data['prod_id'];

        $this->qty = $data['qty'];
    }

    public function getTable() {
        return 'cartItems';
    }

    public function getProduct() {
        return Product::find($this->prod_id);
    }

    public function getItemPrice() {
        return $this->getProduct()->getLastPrice();
    }
}