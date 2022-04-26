<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_id',
        'content',
    ];
    public function date(){
        return $this->belongsTo(related: Date::class, foreignKey: 'date_id', ownerKey:'id');
    }
}
