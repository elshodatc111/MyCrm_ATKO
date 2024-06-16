<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('addres');
            $table->string('tkun');
            $table->string('smm');
            $table->string('status')->default('new');// Register , Arxiv , Deleted
            $table->string('commit')->nullable();
            $table->string('user_id')->nullable();
            $table->string('meneger')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
