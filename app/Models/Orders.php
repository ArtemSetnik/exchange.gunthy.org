<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Orders extends Model
{

	protected $table = "orders";

	/**
	* The attributes that are not mass assignable.
	*
	* @var array
	*/
	protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'date',
		'order_type',
        'amount',
        'price',
        'market_price',
        'currency',
        'c_currency'
	];
	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		'secret'
    ];

}
