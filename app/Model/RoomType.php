<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'type_id');
    }
}