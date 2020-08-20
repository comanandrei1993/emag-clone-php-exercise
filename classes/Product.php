<?php

class Product extends BaseTable {
    public $id;

    public $name;

    public $pictures;

    public $oldPrice;

    public $discount;

    public $price;

    public $stoc;

    public $review;

    public $code;

    public $category;

    public $subcategory;

    /**
     * Product constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->id = $data['id'];

        $this->name = $data['name'];

        $this->pictures = $data['pictures'];

        $this->oldPrice = $data['oldPrice'];

        $this->discount = $data['discount'];

        $this->stoc = $data['stoc'];

        $this->review = $data['review'];

        $this->code = $data['code'];

        $this->category = $data['category'];

        $this->subcategory = $data['subcategory'];
    }

    public function getAverageReviewScore() {
        $reviews = $this->getReviews();
        $revScore = 0;

        foreach ($reviews as $review) {
            $revScore += $review->score;
        }

        if (count($reviews) != 0) {
            return number_format((float)($revScore / count($reviews)), 2);
        } else {
            return 0;
        }
    }

    public function getCategory() {
        return ProductCategory::find($this->category);
    }

    public function getFavedStatus() {
        $isFaved = false;

        if (preg_match('/[A-Za-z]+/', $_SESSION['user_id'])) {
            $user = TempUser::findOneBy(['user_id' => $_SESSION['user_id']]);
        } else {
            $user = User::find($_SESSION['user_id']);
        }

        $favorites = $user->getFavorites();

        foreach ($favorites as $favorite) {
            if ($favorite->getProduct()->id == $this->id) {
                $isFaved = true;
            }
        }

        return $isFaved;
    }

    public function getLastPrice() {
        return ceil($this->oldPrice * ((100 - $this->discount) / 100)) - 0.01;
    }

    public function getPictures() {
        return Picture::findBy(['product_id' => $this->id]);
    }

    public function getReviews() {
        return Review::findBy(['product_id' => $this->id]);
    }

    public function getSubcategory() {
        return ProductSubcategory::find($this->subcategory);
    }

    public function getTable() {
        return 'products';
    }


}







