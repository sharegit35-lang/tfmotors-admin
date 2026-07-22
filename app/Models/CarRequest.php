<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarRequest extends Model
{
    protected $fillable = [
        'name', 'department', 'destination', 'purpose', 'start_time', 'end_time', 'status'
    ];
}
