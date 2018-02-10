<?php

namespace App\Models;
use Eloquent;

class Rating extends Eloquent
{
    protected $table = 'tbl_rating';
    protected $primaryKey ='ratingID'; 
    public function user()
    {
        return $this->hasOne('App\Models\Fbuser','ausrid','nusrid');
    }

}