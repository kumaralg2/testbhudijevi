<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model {

    protected $table = 'tbltrainingbatchmaster';
    
    protected $primaryKey ='aTrainingBatchMasterID';

    public function Course()
    {
        return $this->belongsTo('App\Models\Course', 'nCourseMasterid', 'aCourseMasterid');
    }
    
    public function scopeValidbatch($query){
        $query->where('nbatchstatus', '=', 1);
        //$query->where('dEnrolmentExpDate','>=',date('Y-m-d'));
        $query->orderBy('dEnrolmentExpDate','asc');        
        return $query;       
    }
    
    public function filter_sectors(){
        return $this->Course()->where('nSectorID','=','1001');
    }
    
    public function ratings()
    {
        return $this->hasMany('App\Models\Rating', 'nTrainingBatchID','aTrainingBatchMasterID');
    }

}
