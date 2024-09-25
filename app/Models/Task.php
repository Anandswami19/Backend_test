<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    use HasFactory;
    protected $fillable = [
        'id', 'title', 'description','completed','created_at','updated_at'
    ];
}
