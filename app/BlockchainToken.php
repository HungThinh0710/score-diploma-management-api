<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockchainToken extends Model
{
    protected $table = 'blockchain_tokens';
    protected $fillable = ['user_id', 'token', 'expires_at'];
    public $timestamps = true;
    public $incrementing = true;

    public function user()
    {
        return $this->hasOne('App\User', 'user_id','id');
    }
}
