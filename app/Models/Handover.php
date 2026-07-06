<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handover extends Model
{
    protected $fillable = ['employee_name', 'position', 'branch', 'handover_date', 'status'];

    public function items()
    {
        return $this->hasMany(HandoverItem::class);
    }
}
