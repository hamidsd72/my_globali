<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function langs()
    {
        return $this->morphTo();
    }

}
