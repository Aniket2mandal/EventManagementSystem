<?php

namespace App\Models;

use App\Models\Attendee;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    // use HasFactory;
    protected $fillable = [
        'title', 'description', 'date', 'location', 'category_id'
    ];

    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
