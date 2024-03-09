<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_qualification extends Model
{
    use HasFactory;
    protected $fillable = [
        "examination",
        "board",
        "percentage",
        "year_of_passing",
        "student_id"
        
    ];
}
