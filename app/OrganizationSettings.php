<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationSettings extends Model
{
    protected $table = 'organization_settings';
    protected $fillable = ['is_direct_submit_transcript', 'is_activate_email_domain'];
    public $timestamps = false;
    public $incrementing = true;

    public function org()
    {
        return $this->belongsTo('App\Organization');
    }
}
