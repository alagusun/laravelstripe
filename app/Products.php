<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    //
	
	  protected $table = 'products';
	  protected $primaryKey = 'id';
	   protected $dates = ['trial_ends_at', 'subscription_ends_at'];
	  
	   protected $fillable = [
        'name', 'email', 'password',
    ];
}
