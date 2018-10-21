<?php

namespace App\Http\Controllers;

use App\Http\Resources\Transaction\TransactionResource;
use Illuminate\Http\Request;
use App\Models\{Transaction};

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return Transaction::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TransactionResource(Transaction::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
