<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    /** @use HasFactory<\Database\Factories\UniversityFactory> */
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name',
        'city',
        'slug',
        'logo',
        'about',
        'accommodation',
        'finance',
        'scholarships',
        'research',
        'pathway',
    ];

    function country() {
        return $this->belongsTo(Country::class);
    }

    function images() {
        return $this->hasMany(UniversityImage::class);
    }

    function programs() {
        return $this->hasMany(Program::class);
    }
}
