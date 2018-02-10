<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coursecomplexity extends Model {

    protected $table = 'tblcoursecomplexitymaster';
    
    protected $primaryKey ='aCoursecomplexityMasterID';
    
    public function course()
    {
        return $this->hasMany('App\Models\Course','nCourseComplexityID', 'aCoursecomplexityMasterID');
    }

}
