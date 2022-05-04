<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Task extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $messeger = 'thành công';
    protected $fillable = [
        'user_id',
        'event_id',
        'content',
        'date',
        'img',
    ];
    public function users(){
        return $this->belongsTo(related: User::class, foreignKey: 'user_id', ownerKey:'id');
    }
    public function events(){
        return $this->belongsTo(related: Event::class, foreignKey: 'event_id', ownerKey:'id');
    }
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::created(function ($model) {
            
    //         $email_to = Auth::user()->email;
    //         Mail::send('mail',$data =[], function($message) use ($email_to){
    //             $message->from('nguyennhattruong11223344@gmail.com', 'thông báo thành công');
    //             $message->to($email_to, $email_to);
    //             $message->subject('Thông báo thành công ');
    //         });
    //     });
    // }
}
