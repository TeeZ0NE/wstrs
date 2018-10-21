<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
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
    		'data'=>[
    		'transactionId'=>$this->id,
		    'customerId'=>$this->user_id,
		    'amount'=>$this->amount,
		    'date'=>$this->date,
			    ]
	    ];
//        return parent::toArray($request);
    }
}
