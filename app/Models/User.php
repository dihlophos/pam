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
    
    public function objects()
    {
        return $this->belongsToMany(Object::class);
    }

    public function hasAccessToObject(Object $object)
    {
        if ($this->isAdmin)
        {
            return true;
        }

        if ($this->attachedToSubdivision() && $this->subdivision->id == $object->subdivision->id)
        {
            return true;
        }

        if ($this->attachedToInstitution() && $this->institution->id == $object->institution->id)
        {
            return true;
        }

        if ($this->attachedToOrgan() && $this->organ->id == $object->organ->id)
        {
            return true;
        }

        return false;
    }

    public function hasAccessToSubdivision(Subdivision $subdivision)
    {
        if ($this->isAdmin)
        {
            return true;
        }

        if ($this->attachedToSubdivision() && $this->subdivision->id == $subdivision->id)
        {
            return true;
        }

        if ($this->attachedToInstitution() && $this->institution->id == $subdivision->institution->id)
        {
            return true;
        }

        if ($this->attachedToOrgan() && $this->organ->id == $subdivision->institution->organ->id)
        {
            return true;
        }

        return false;
    }

    public function hasAccessToInstitution(Institution $institution)
    {
        if ($this->isAdmin)
        {
            return true;
        }

        if ($this->institution->id == $institution->id)
        {
            return true;
        }

        if ($this->attachedToOrgan() && $this->organ->id == $institution->organ->id)
        {
            return true;
        }

        return false;
    }

    public function hasAccessToOrgan(Institution $organ)
    {
        if ($this->isAdmin)
        {
            return true;
        }

        if ($this->organ->id == $organ->id)
        {
            return true;
        }

        return false;
    }

    public function isAdmin()
    {
        return ($this->is_admin);
    }

    public function attachedToOrgan()
    {
        return $this->organ != null;
    }

    public function attachedToInstitution()
    {
        return $this->institution != null;
    }

    public function attachedToSubdivision()
    {
        return $this->subdivision != null;
    }

    public function scopeByUserName($query, $username)
    {
        return $query->where('username', '=', $username)->first();
    }
}
