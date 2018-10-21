<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    	try {
		    return [
			    'transactionId' => isset($this->id) ? $this->id : 'no transactions',
			    'customerId' => isset($this->user_id)?$this->user_id : $request->customerid,
			    'amount' => isset($this->amount) ? $this->amount : 0.00,
			    'date' => isset($this->date) ? $this->date : '',
		    ];
	    }catch(\Exception $e) {
		    return [
			    'message' => 'Not found'.$e->getMessage(),
		    ];
	    }
    }
}
