<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;
    //データ取得の制限
    public function getpaginateByLimit(int $limit_count = 3)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    protected $dates=[
        'start_time',
        'end_time'
        ];
    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'location',
        'event_content',
        'jenre_id',
        'group_id',
        'user_id',
        ];
    public function jenre()
    {
        return $this->belongsTo(Jenre::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
