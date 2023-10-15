<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentSponsorship extends Model
{
    use HasFactory;
    protected $table = 'apartment_sponsorship';
    public $timestamps = false;
    
    protected $fillable = [
        'apartment_id', 
        'sponsorship_id', 
        'init_date', 
        'end_date'
    ];
}
