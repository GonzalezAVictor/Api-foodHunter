<?php
namespace App\Transformer;

use League\Fractal;
use App\Category;

class CategoryTransformer extends Fractal\TransformerAbstract
{
	public function transform(Category $category)
	{
	    return [
	        'id' => $category->id,
	        'name' => $category->name,
	    ];
	}
}