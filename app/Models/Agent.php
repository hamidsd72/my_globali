<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
        "user_id",
        "zone",
        "aria",
        "address",
        "company_name",
        "bank_name",
        "bank_number",
        "passport_number",
        "status",           // 'pending', 'active', 'block'
    ];

    public function langs()
    {
        return $this->morphMany('App\Models\Lang', 'langs');
    }

}