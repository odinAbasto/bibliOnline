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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
                $table->string("title",50);
                $table->unsignedBigInteger("author_id")->nullable();
                $table->year("year")->nullable();
                $table->string("file_path",100)->nullable();
                $table->string("cover_path",100)->nullable();
                $table->text("synopsis")->nullable();
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
