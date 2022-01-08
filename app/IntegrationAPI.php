<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegrationAPI extends Model
{
    protected $table = 'integration_api';
    protected $fillable = ['org_id', 'api', 'is_activate'];
    public $incrementing = true;
    public $timestamps = true;

    public function org()
    {
        return $this->belongsTo('App\Organization', 'org_id', 'id');
    }
}
