<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramFactory> */
    use HasFactory;

    protected $fillable = [
        'university_id',
        'title',
        'slug',
        'degree_level',
        'duration',
        'tuition',
        'description',
    ];

    function university() {
        return $this->belongsTo(University::class);
    }
}
