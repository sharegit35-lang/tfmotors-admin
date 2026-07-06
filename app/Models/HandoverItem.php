<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HandoverItem extends Model
{
    protected $fillable = ['handover_id', 'description', 'serial_number', 'quantity', 'asset_code', 'condition'];

    public function handover()
    {
        return $this->belongsTo(Handover::class);
    }
}
