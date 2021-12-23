<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = ['org_id', 'subject_name', 'subject_code', 'credit'];
    public $incrementing = true;
    public $timestamps = false;

//    public function major()
//    {
//        return $this->belongsTo('App\Major', 'major_id', 'id');
//    }
//
    public function majors()
    {
        return $this->belongsToMany('App\Major', 'major_subject', 'subject_id', 'major_id');
    }

}
