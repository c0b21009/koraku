<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenre extends Model
{
    use HasFactory;
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function getByJenre(int $limit_count = 2)
    {
        return $this->events()->with('jenre')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
