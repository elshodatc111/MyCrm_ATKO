<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('onlines', function (Blueprint $table) {
            $table->id();
            $table->integer('cours_id');
            $table->integer('cours_id_api');
            $table->string('cours_id_api_name');
            $table->string('meneger');
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('onlines');
    }
};
