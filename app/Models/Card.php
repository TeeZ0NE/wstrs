<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	public $timestamps = false;
	protected $fillable = ['user_id', 'cno', 'yy', 'mm', 'cvv2'];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	 * Get card Id or create new
	 *
	 * @param int $user_id
	 * @param array $card_data
	 * @return int
	 */
	public function getCardIdWithData(int $user_id, array $card_data)
	{
		return $this->firstOrCreate(['user_id' => $user_id], $card_data)->id;
	}

	/**
	 * Get first card id from customer cards
	 *
	 * If Customer has cards will return first one or zero
	 * @param int $user_id
	 * @return int
	 */
	public function getFirstCardId(int $user_id): int
	{
		return $this->where('user_id', $user_id)->first()->id ?? 0;
	}
}
