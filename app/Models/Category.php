<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    // use HasFactory;
    protected $fillable = [
        'name'
    ];
    // ALTERNATIVE
    protected $guard=[];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
