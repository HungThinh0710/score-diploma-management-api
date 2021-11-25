<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InQueueTranscript extends Model
{
    protected $table = 'inqueue_transcripts';
    protected $fillable = ['class_id', 'student_code', 'payload'];
    public $timestamps = true;
    public $incrementing = true;

    public function classRoom()
    {
        return $this->belongsTo('App\ClassRoom');
    }
}
