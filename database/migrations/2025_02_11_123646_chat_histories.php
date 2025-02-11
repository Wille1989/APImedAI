<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('chat_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->uuid('session_id');
            $table->text('user_message');
            $table->text('bot_response');
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_histories');
    }
};
