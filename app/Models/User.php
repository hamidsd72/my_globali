<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at'];
   
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        "type",             // 'admin', 'customer', 'agent', 'sales_office'
        "first_name",
        "last_name",
        "username",
        "sex",              // 'man', 'woman', 'other' 
        "mobile",
        "mobile_status",    // 'pending', 'active', 'block'
        "email",
        "country",
        "country_code",
        "city",
        "birth_day_fa",
        "birth_day_en",
        "password"
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    public function agent()
    {
        return $this->hasOne('App\Models\Agent', 'user_id');
    }
    public function sales_office()
    {
        return $this->hasOne('App\Models\SalesOffice', 'user_id');
    }
    public function user_info()
    {
        return $this->hasOne('App\Models\UserComplete', 'user_id');
    }
    public function photo()
    {
        return $this->morphOne('App\Models\Photo', 'pictures')->where('status','active')->where('type','photo');
    }
    public function user_work()
    {
        return $this->hasOne('App\Models\UserWork', 'user_id');
    }
     public function user_token()
    {
        return $this->hasOne('App\Models\UserToken', 'user_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            if($item->photo)
            {
                if(is_file($item->photo->path))
                {
                    File::delete($item->photo->path);
                }
                $item->photo->delete();
            }
             if($item->user_work)
            {
                $item->user_work->delete();
            }
             if($item->user_token)
            {
                $item->user_token->delete();
            }
        });
    }
}
