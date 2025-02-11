<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ChatHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id', 'user_message', 'bot_response'];

    // Generera ett unikt session_id när ett nytt meddelande sparas
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($chat) {
            if (!$chat->session_id) {
                $chat->session_id = Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

}
