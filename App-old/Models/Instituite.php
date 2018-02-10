<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituite extends Model {

    protected $table = 'tblinstitutemaster';
    
    protected $primaryKey ='aInstituteID';
    
    public function course()
    {
        return $this->hasMany('App\Models\Course','nInstituteID', 'aInstituteID');
    }

}
