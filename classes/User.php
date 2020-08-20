<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 16-Aug-20
 * Time: 11:52 AM
 */
class User extends BaseTable {
    public $id;

    public $email;

    public $password;

    public $status;

    /**
     * Review constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->id = $data['id'];

        $this->email = $data['email'];

        $this->password = $data['password'];

        $this->status = $data['status'];
    }

    public function getTable() {
        return 'users';
    }

    public function getFavorites() {
        return Favorite::findBy(['user_id' => $this->id]);
    }

    public function getCart() {
        return ShopCart::findOneBy(['user_id' => $this->id]);
    }

//    static function getCartItems() {
//        return CartItem::findBy(['cart_id' => self::getCart()->id]);
//    }
}