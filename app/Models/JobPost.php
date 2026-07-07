<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    // អនុញ្ញាតឱ្យបញ្ជូលទិន្នន័យទៅកាន់ Field ទាំងនេះបាន
    protected $fillable = [
        'title', 'employment_type', 'salary_range', 'location', 'description', 'status'
    ];
}