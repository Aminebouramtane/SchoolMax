<?php

namespace App\Repository;


interface PromotionRepositoryInterface {

    public function getPromotion();
    public function ListPromotion();
    public function StorePromotion($request);
    public function rollback($request,$id);
}
