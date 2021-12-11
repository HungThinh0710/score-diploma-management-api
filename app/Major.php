<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $table = 'majors';
    protected $fillable = ['org_id', 'major_name', 'majar_code'];
    public $incrementing = true;

    public function org()
    {
        return $this->belongsTo('App\Organization', 'org_id', 'id');
    }

    public function majors()
    {
        return $this->hasMany('App\Major', 'major_id','id');
    }

}
