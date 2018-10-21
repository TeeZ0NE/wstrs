<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Http\Resources\Transaction\TransactionCollection;
use App\Http\Resources\Transaction\TransactionResource;
use Illuminate\Http\Request;
use App\Models\{Transaction,Card};
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api')->except(['show']);
	}

	/**
	 * All transaction for user
	 *
	 * @param Transaction $transaction
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
    public function index(Transaction $transaction)
    {

      return TransactionCollection::collection($transaction->getTransaction4UserViaApi(Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\TransactionRequest $request
     * @return TransactionResource
     */
    public function store(TransactionRequest $request)
    {
	    $card_m = new Card();
	    $transaction_m = new Transaction();
	    $user_id = Auth::user()->id;
	    $amount = $request->amount;
	    $card_id = $card_m->getFirstCardId($user_id);
	    $transaction = $transaction_m->addTransaction($user_id,(double)$amount,$card_id);
	    return new TransactionResource($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return TransactionResource
     */
    public function show($id)
    {
        return new TransactionResource(Transaction::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TransactionUpdateRequest  $request
     * @param  int  $id
     * @return TransactionResource
     */
    public function update(TransactionUpdateRequest $request, $id)
    {
	    $transaction_m = new Transaction();
	    $amount = $request->amount;
	    $transaction = $transaction_m->updateTransaction($id,$amount);
	    return new TransactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string;
     */
    public function destroy($id)
    {
	    $transaction_m = new Transaction();
	    $response = $transaction_m->deleteTransaction($id);
	    return $response;
    }

	/**
	 * Get transaction with attributes
	 *
	 * @param $customerid
	 * @param $transactionid
	 * @return TransactionResource
	 */
	public function get($customerid,$transactionid)
	{
		$transaction_m = new Transaction();
		$transaction = $transaction_m->getTransactionById($customerid,$transactionid);
		return new TransactionResource($transaction, $customerid);
	}

	/**
	 * Get transaction with filter
	 *
	 * @param $customerid
	 * @param Request $request
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function filter($customerid, Request $request)
	{
		$amount = (double)$request->amount;
		$date = $request->date;
		$offset = (int)$request->offset;
		$limit = ($request->limit)?(int)$request->limit:1;
		$transaction_m = new Transaction();
		return $transaction_m->getFullTransactionFromSearch((int)$customerid,$amount,$date,$offset,$limit);
	}
}
