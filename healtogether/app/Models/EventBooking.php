<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    protected $fillable = ['name', 'email', 'phone_number'];
    use HasFactory;
}
