<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'tblcoursecataloguemaster';
    
    protected $primaryKey ='aCourseMasterID';
    
    public function batch()
    {
        return $this->hasMany('App\Models\Batch','aCourseMasterid', 'nCourseMasterid');
    }
    
    public function Instituite()
    {
        return $this->hasOne('App\Models\Instituite', 'aInstituteID', 'nInstituteID');
    }    

    public function Coursecomplexity()
    {
        return $this->hasOne('App\Models\Coursecomplexity', 'aCoursecomplexityMasterID', 'nCoursecomplexityID');
    }
}