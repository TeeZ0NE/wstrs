<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\Resource;

class TransactionCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    	return [
    		'transactionId'=>$this->id,
		    'customerId'=>$this->user_id,
		    'amount'=>$this->amount,
		    'date'=>$this->date,
	    ];
//        return parent::toArray($request);
    }
}
