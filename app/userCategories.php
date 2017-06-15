<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategories extends Model
{
  protected $table = 'user_categories';

  protected $fillable = [
  'pasta',
  'pizza',
  'hamburguesa',
  'bebidas',
  'tacos',
  'baguettes',
  'dogos',
  'mariscos',
  'postres',
  'cafe'
  ];
}
