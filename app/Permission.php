<?php

namespace App;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public $guard_name = 'web';
    protected $fillable = ['name', 'guard_name'];
}
