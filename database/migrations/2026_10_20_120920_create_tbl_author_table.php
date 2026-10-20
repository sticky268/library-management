<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblAuthor', function (Blueprint $table) {
            $table->id('AuthorID');
            $table->string('AuthorName');
            $table->string('Gender', 20)->nullable();
            $table->date('DOB')->nullable();
            $table->string('POB')->nullable();
            $table->text('Address')->nullable();
            $table->string('Phone', 30)->nullable();
            $table->string('Email')->nullable();
            $table->string('Photo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblAuthor');
    }
};