<?php

/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 18-Aug-20
 * Time: 11:01 AM
 */
class TempUser extends BaseTable {
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
        return 'tempUsers';
    }

    public function getFavorites() {
        return Favorite::findBy(['user_id' => $this->user_id]);
    }

    public function getCart() {
        return ShopCart::findOneBy(['user_id' => $this->user_id]);
    }

    static function getCartItems() {
        return CartItem::findBy(['cart_id' => self::getCart()->id]);
    }
}