<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks'; // Specify the actual table name

    protected $fillable = ['title', 'description', 'user_name', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan model User
    //public function user()
    //{
    //    return $this->belongsTo(User::class, 'user_name', 'email');
    //}

}
