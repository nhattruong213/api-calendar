<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'content',
        'date',
        'img',
    ];
    public function users(){
        return $this->belongsTo(related: User::class, foreignKey: 'user_id', ownerKey:'id');
    }
}
