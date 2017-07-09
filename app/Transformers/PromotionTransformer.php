<?php
namespace App\Transformer;

use League\Fractal;
use App\Promotion;

class PromotionTransformer extends Fractal\TransformerAbstract
{
    public function transform(Promotion $promotion)
    {
        return [
            'id' => $promotion['id'],
            'name' => $promotion['name'],
            'details' => $promotion['details'],
            'startAt' => $promotion['startAt'],
            'endAt' => $promotion['endAt'],
            'active' => $promotion['active'],
            'promotion_type' => $promotion['promotion_type'],
            'amount_available' => $promotion['amount_available']
        ];
    }
}