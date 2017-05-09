<?php
namespace App\Transformer;

use League\Fractal;

class BookTransformer extends Fractal\TransformerAbstract
{
	public function transform($algo)
	{
	    return [
	        'algo' => $algo,
	    ];
	}
}