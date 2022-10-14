<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function orders_technician()
    {
        return $this->hasMany(Order::class,'technician_id');
    }

    public function orders_creator()
    {
        return $this->hasMany(Order::class,'created_by');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        return $this->role->permissions ?? false;
    }

    public function hasPermission($permission)
    {
        if ($this->permissions()){
            if($this->permissions()->contains('id',$permission))
            {
                return true;
            }
        }
        return false;
    }

    public function getNameAttribute($value) {
        if (App::getLocale() == 'ar'){
            return $this->name_ar ?? $this->name_en;
        }else{
            return $this->name_en ?? $this->name_ar;
        }
    }

}
