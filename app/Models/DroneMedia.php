<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
class DroneMedia extends Model 
{
    use HasFactory;
    protected $fillable = [
        'url',  // Optional for cloud storage URL
        'filename',
        'user_id', // Associate with authenticated user
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }

    // Implement JWTSubject contract methods (if using JWT for user identification)
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return []; // You can add custom claims if needed
    }

}
