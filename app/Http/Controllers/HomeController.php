<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
    	$transactions = $transaction->getTransaction4GuiUser(Auth::user()->id);
        return view('home')->with([
        	'transactions'=>$transactions,
	        'links'=>$transactions->links()
        ]);
    }
}
