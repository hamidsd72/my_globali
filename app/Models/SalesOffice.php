<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOffice extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
        "user_id",
        "zone",
        "aria",
        "address",
        "company_name",
        "company_code_maliati",
        "code_melli",
        "project_name",
        "status",           // 'pending', 'active', 'block'
    ];

    public function langs()
    {
        return $this->morphMany('App\Models\Lang', 'langs');
    }

}