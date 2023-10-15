<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['guest_name', 'guest_email', 'message'];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
