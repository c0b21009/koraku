<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $fillable = ['datetime', 'schedule'];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}