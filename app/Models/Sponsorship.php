<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'level',
        'price',
        'duration'
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
