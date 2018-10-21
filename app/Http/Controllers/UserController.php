<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Card};

class UserController extends Controller
{
	public function __invoke(Request $request)
	{
		$name = $request->name;
		$card = [
			'cno'=>$request->cnp,
			'cvv2'=>$request->cvv2??0,
			'mm'=>$request->mm??0,
			'yy'=>$request->yy??0,
		];
		$user_m = new User();
		$user_id = $user_m->getCustomerId($name);
		if($user_id){
			$card_m = new Card();
			$card_id = $card_m->getCardIdWithData($user_id,$card);
			return $user_id;
		}
		return null;
    }
}
