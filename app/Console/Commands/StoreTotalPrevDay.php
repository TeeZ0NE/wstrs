<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use Carbon\Carbon;

class StoreTotalPrevDay extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'store:sum';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Store total sum from previous day';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$transaction_m = new Transaction();
		echo (file_put_contents(storage_path() . '/app/public/cron/amount.txt', sprintf("Date: %s, amount: %.2f \n", Carbon::now()->yesterday()->toDateString(), $transaction_m->totalYestrdayAmount()), FILE_APPEND)) ? "Sum Saved" : "Sum not saved";
	}
}
