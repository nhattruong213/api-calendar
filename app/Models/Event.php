<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'color',
    ];
    public function tasks(){
        return $this->hasMany(related: Task::class, foreignKey: 'event_id', localKey:'id');
    }
}
