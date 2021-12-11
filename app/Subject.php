<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = ['major_id', 'subject_name', 'subject_code', 'credit'];
    public $incrementing = true;
    public $timestamps = false;

    public function major()
    {
        return $this->belongsTo('App\Major', 'major_id', 'id');
    }

}
