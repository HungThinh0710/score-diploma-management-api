<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    protected $table = 'transcripts';
    protected $fillable = ['class_id', 'student_code', 'trxID', 'block_number', 'payload_hash'];
    public $timestamps = true;
    public $incrementing = true;

    public function classRoom()
    {
        return $this->belongsTo('App\ClassRoom');
    }
}
