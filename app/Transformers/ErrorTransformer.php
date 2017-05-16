<?php
namespace App\Transformer;

use Illuminate\Http\Request;
use League\Fractal;

class ErrorTransformer extends Fractal\TransformerAbstract
{
	public function transform(Request $request)
	{
	    return [
	        'message' => $request->message,
	    ];
	}
}