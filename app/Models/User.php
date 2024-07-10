<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    // public $timestamps = false;

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'phoneNumber',
        'gender',
        'country',
        'state'
    ];

    public $appends = ['full_name'];

    // public function getFullNameAttribute()
    // {
    //     return $this->firstName . ' ' . $this->lastName;
    // }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'hobby_user');
    }
}
