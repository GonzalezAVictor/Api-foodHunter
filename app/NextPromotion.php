<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NextPromotion extends Model
{
    protected $table = 'next_promotion';

    protected $fillable = [
      'startAt',
      'endAt',
      'promotion_type',
      'amount_available'
    ];
}
