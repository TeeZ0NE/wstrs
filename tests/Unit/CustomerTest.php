<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{
	User, Card, Transaction
};

class CustomerTest extends TestCase
{
	private $user_m;
	private $card_m;
	private $transaction_m;

	public function setUp()
	{
		parent::setUp();
		$this->card_m = new Card();
		$this->user_m = new User();
		$this->transaction_m = new Transaction();
	}

	/**
	 * @test
	 */
	public function check_create_user()
	{
		$name = 'Bill';
		$user_id = $this->user_m->getCustomerId($name);
		$this->assertGreaterThan(0, $user_id);
		return $user_id;
	}

	/**
	 * @test
	 * @depends check_create_user
	 * @param int $user_id
	 */
	public function check_add_card_2_customer($user_id)
	{
		$card = [
			'cno' => 5555666677778888,
			'cvv2' => 123,
			'mm' => 4,
			'yy' => 25,
		];
		$card_id = $this->card_m->getCardIdWithData($user_id, $card);
		$this->assertEquals(2, $card_id);
	}

	/**
	 * @test
	 */
	public function check_get_first_card_id()
	{
		$this->assertGreaterThanOrEqual(0,$this->card_m->getFirstCardId(3));
	}

	/**
	 * @test-
	 */
	public function check_add_transaction()
	{
		$amount = 352.68;
		$user_id = 2;
		$card_id = $this->card_m->getFirstCardId($user_id);
		$this->assertGreaterThan(0, $this->transaction_m->addTransaction($user_id,$amount,$card_id));
	}
	/**
	 * @test
	 */
	public function check_get_transaction_data_by_id()
	{
		$this->assertNotEmpty($this->transaction_m->getTransactionById(2,3));
	}
	
	/**
	 * @test-
	 */
	public function check_search_transaction()
	{
		//Request:​ customerId, amount, date, offset, limit
		$user_id= 1;
		$amount = 123.58;
		$date = '20.03.2018';
		$offset=1;
		$limit=2;
		$this->assertNotEmpty($this->transaction_m->getFullTransactionFromSearch($user_id,$amount,$date)->first());
	}
	
	/**
	 * @test
	 */
	public function check_update_transact()
	{
		$this->assertNotEmpty($this->transaction_m->updateTransaction(3,123.58));
	}

	/**
	 * @test
	 */
	public function check_delete_transaction()
	{
		$this->assertEquals('fail',$this->transaction_m->deleteTransaction(2));
	}
}
