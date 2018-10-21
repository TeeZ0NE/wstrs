<?php
define('LARAVEL_START', microtime(true));
require_once __DIR__ . './../vendor/autoload.php';
$app = require_once __DIR__.'./../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$compiledPath = __DIR__.'/storage/framework/compiled.php';
if (file_exists($compiledPath))
{
	require $compiledPath;
}
use App\Models\Transaction;
$transaction_m = new Transaction();
file_put_contents(storage_path().'/app/public/cron/amount.txt',sprintf('Date: %s, amount: %.2f',\Carbon\Carbon::now()->yesterday(),$transaction_m->totalYestrdayAmount()),FILE_APPEND);