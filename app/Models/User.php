<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'displayname', 'email', 'password', 'is_admin',
        'role_id', 'organ_id', 'institution_id', 'subdivision_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function organ()
    {
        return $this->belongsTo(Organ::class);
    }
    
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    
    public function subdivision()
    {
        return $this->belongsTo(Subdivision::class);
    }

    public function isAdmin()
    {
        return ($this->is_admin);
    }

    public function scopeByUserName($query, $username)
    {
        return $query->where('username', '=', $username)->first();
    }
}
