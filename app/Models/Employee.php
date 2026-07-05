<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    protected $fillable = [
        'english_name', 
        'khmer_name', 
        'gender', 
        'identity_card', 
        'cambodian_passport', 
        'phone', 
        'position', 
        'department_name', 
        'branch_name', 
        'branch_code', 
        'start_work', 
        'date_of_birth', 
        'salary', 
        'hire_date', 
        'status' // CRITICAL: Must be here!
    ];
}

