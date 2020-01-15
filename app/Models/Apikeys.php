<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Apikeys extends Model
{

	protected $table = "api_keys";

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
		'user_id',
		'key',
		'secret'
	];
	
	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		'secret'
    ];

    public function user(){
      return $this->belongsTo('App\Models\User', 'user_id');
  }

}
