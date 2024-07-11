<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'country_id',
        'state_id',
        'phone_number',
        'gender'
    ];

    // public $appends = ['full_name'];

    // public function getFullNameAttribute()
    // {
    //     return $this->firstName . ' ' . $this->lastName;
    // }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'hobby_user');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
