<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    use HasFactory;

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'hobby_user');
    }
}
