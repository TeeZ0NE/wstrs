<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cards()
	{
		return $this->hasMany(Card::class,'user_id');
    }
	/**
	 * Inserting if not exists user
	 *
	 * Insert new customer data and return own ID
	 * @param string $name
	 * @param string|null $pass
	 * @param string|null $email
	 * @return int ID
	 */
	public function getCustomerId(string $name, string $pass='111111', string $email=null):int
	{
		return $this::firstOrCreate(['username'=>$name],['password'=>bcrypt($pass),'email'=>$email])->id;
    }
}
