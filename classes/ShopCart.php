<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 17-Aug-20
 * Time: 1:12 PM
 */
class ShopCart extends BaseTable {
    public $id;

    public $user_id;

    /**
     * Review constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->id = $data['id'];

        $this->user_id = $data['user_id'];
    }

    public function getTable() {
        return 'shopCarts';
    }

    public function getCartItems() {
        return CartItem::findBy(['cart_id' => $this->id]);
    }

    public function getUser() {
        return User::find($this->user_id);
    }

    public function calcTotalPrice() {
        $totalPrice = 0;
        $cartItems = $this->getCartItems();

        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->getItemPrice() * $cartItem->qty;
        }

        return $totalPrice;
    }
}