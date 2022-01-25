<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InQueueTranscript extends Model
{
    protected $table = 'inqueue_transcripts';
    protected $fillable = ['class_id', 'type', 'student_code', 'student_name', 'transcript'];
    public $timestamps = true;
    public $incrementing = true;

    public function getTranscriptAttribute($value)
    {
        return json_decode($value, true);
    }

    public function classRoom()
    {
        return $this->belongsTo('App\ClassRoom', 'class_id', 'id');
    }
}
