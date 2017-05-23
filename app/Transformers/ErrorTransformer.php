<?php
namespace App\Transformer;

use League\Fractal;

class ErrorTransformer extends Fractal\TransformerAbstract
{
	public function transform(Array $error)
	{
	    return [
	        'message' => $error['message'],
	    ];
	}
}