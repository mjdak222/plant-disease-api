<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('diseases', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();   
        $table->text('symptoms')->nullable(); 
        $table->text('treatment')->nullable(); 
        $table->string('image')->nullable(); // 🔥 رابط أو مسار الصورة
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diseases');
    }
};
