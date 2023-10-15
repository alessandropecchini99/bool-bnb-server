<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'apartment_id',
        'ip',
        'date_time',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
