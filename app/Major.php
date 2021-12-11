<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $table = 'majors';
    protected $fillable = ['org_id', 'major_name', 'major_code'];
    public $incrementing = true;
    public $timestamps = false;

    public function org()
    {
        return $this->belongsTo('App\Organization', 'org_id', 'id');
    }

    public function classes()
    {
        return $this->hasMany('App\ClassRoom', 'major_id','id');
    }

    public function subjects()
    {
        return $this->hasMany('App\Subject', 'major_id','id');
    }

}
