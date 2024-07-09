<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    public $timestamps = false;
    // protected $guarded = [];

    protected $fillable = [
        'hobby-name'
    ];

    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'hobby_user');
    }
}
