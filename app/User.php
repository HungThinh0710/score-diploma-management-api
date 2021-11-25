<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'org_id', 'full_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guard_name = 'web';

    public static function boot()
    {
        parent::boot();
//        self::created(function($teamModel){
//            $session_team_id = app(\Spatie\Permission\PermissionRegistrar::class)->getPermissionsTeamId();
//            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId($teamModel->org_id);
//            User::find(1)->assignRole('owner');
//            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId($session_team_id);
//        });
    }

    public function org()
    {
        return $this->belongsTo('App\Organization');
    }

    public function blockchainToken()
    {
        return $this->belongsTo('App\BlockchainToken');
    }

}
