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
    Schema::create('lendings', function (Blueprint $table) {
        $table->id(); 
        $table->foreignId('item_id')->constrained()->onDelete('cascade'); 
        $table->string('name');    
        $table->integer('total');    
        $table->dateTime('date_time'); 
        $table->dateTime('return_date')->nullable();   
        $table->string('notes')->nullable(); 
        $table->boolean('is_returned')->default(false); 
        $table->string('user_id'); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};
