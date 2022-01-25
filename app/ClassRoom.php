<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $table = 'classes';
    protected $fillable = ['org_id', 'major_id','class_name', 'start_year', 'code'];
    public $timestamps = true;
    public $incrementing = true;

    public function org()
    {
        return $this->belongsTo('App\Organization');
    }

    public function transcripts()
    {
        return $this->hasMany('App\Transcript', 'class_id','id');
    }

    public function inQueueTranscripts()
    {
        return $this->hasMany('App\InQueueTranscript', 'class_id','id');
    }

    public function major()
    {
        return $this->belongsTo('App\Major', 'major_id', 'id');
    }

}
