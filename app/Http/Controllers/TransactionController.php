<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Card,Transaction};

class TransactionController extends Controller
{
	public function get($customerid,$transactionid)
	{
		$transaction_m = new Transaction();
		$transaction = $transaction_m->getTransactionById($customerid,$transactionid);
		print_r($transaction);
    }

	public function filter($customerid, Request $request)
	{
		$amount = (double)$request->amount;
		$date = $request->date;
		$offset = (int)$request->offset;
		$limit = ((int)$request->limit)?(int)$request->limit:1;
		$transaction_m = new Transaction();
		print_r($transaction_m->getFullTransactionFromSearch((int)$customerid,$amount,$date,$offset,$limit));
    }

	public function add($customerid,$amount)
	{
		$card_m = new Card();
		$transaction_m = new Transaction();
		$card_id = $card_m->getFirstCardId($customerid);
		$transaction = $transaction_m->addTransaction($customerid,(double)$amount,$card_id);
		print_r($transaction);
    }

	public function update($transactionid, $amount)
	{
		$transaction_m = new Transaction();
		$transaction = $transaction_m->updateTransaction($transactionid,$amount);
		print_r($transaction);
    }

	public function destroy($transactionid)
	{
		$transaction_m = new Transaction();
		$response = $transaction_m->deleteTransaction($transactionid);
		return $response;
    }
}
