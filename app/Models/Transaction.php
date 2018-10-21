<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException as MNFEx;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Transaction extends Model
{
	public $timestamps = false;
	protected $fillable = ['user_id', 'card_id', 'amount', 'date'];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function card()
	{
		return $this->belongsTo(Card::class, 'card_id');
	}

	/**
	 * Add new transaction
	 *
	 * @param int $user_id
	 * @param float $amount
	 * @param int $card_id
	 * @return int id
	 */
	public function addTransaction(int $user_id, float $amount, int $card_id)
	{
		$trnasact_id = $this::insertGetId(['user_id' => $user_id, 'amount' => $amount, 'card_id' => $card_id, 'date' => date(now())]);
		return $this->select('id','user_id','date','amount')->find($trnasact_id);
	}

	/**
	 * Get transaction data
	 *
	 * @param int $user_id
	 * @param int $transaction_id
	 * @return mixed
	 */
	public function getTransactionById(int $user_id, int $transaction_id)
	{
		return $this::where(['user_id' => $user_id, 'id' => $transaction_id])->first();
	}

	/**
	 * Get Full info with search
	 *
	 * Getting full information about Customer and own card
	 * using And where condition
	 *
	 * @param int $user_id
	 * @param float $amount
	 * @param string $date
	 * @param int $offset
	 * @param int $limit
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getFullTransactionFromSearch(int $user_id, float $amount, string $date, int $offset = 0, int $limit = 1)
	{
		return $this::with(['user', 'card'])->
		where([
			['user_id', '=', $user_id],
			['amount', '=', $amount],
			['date', '=', date(Carbon::now()->toDateString($date))]
		])->
		offset($offset)->
		limit($limit)->
		get();
	}

	/**
	 * Update transaction
	 *
	 * @param int $transaction_id
	 * @param float $amount
	 * @return null|object
	 */
	public function updateTransaction(int $transaction_id, float $amount)
	{
		try {
			$this::findOrFail($transaction_id)->
			update(['amount' => $amount]);
			return $this::find($transaction_id);
		} catch (MNFEx $mnf) {
			return null;
		}
	}

	/**
	 * Delete transaction
	 *
	 * @param int $transaction_id
	 * @return string
	 */
	public function deleteTransaction(int $transaction_id)
	{
		try {
			$deleted = $this::findOrFail($transaction_id)->delete();
			return $deleted ? 'success' : 'fail';
		} catch (MNFEx $mnf) {
			return 'fail';
		}
	}
}
