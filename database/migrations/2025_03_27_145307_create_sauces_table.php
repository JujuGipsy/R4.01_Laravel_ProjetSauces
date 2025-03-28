<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sauces', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('name');
            $table->string('manufacturer');
            $table->string('description');
            $table->string('mainPepper');
            $table->string('imageUrl')->unique();
            $table->integer('heat')->nullable();
            $table->integer('likes');
            $table->integer('dislikes');
            $table->json('userLiked')->nullable()->change();
            $table->json('userDisliked')->nullable()->change();
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::table('sauces', function (Blueprint $table) {
            $table->json('userLiked')->nullable(false)->change();
            $table->json('userDisliked')->nullable(false)->change();
        });
    }
};
