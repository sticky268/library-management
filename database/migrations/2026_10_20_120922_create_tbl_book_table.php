<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblBook', function (Blueprint $table) {
            $table->id('BookID');
            $table->string('BookTitle');
            $table->foreignId('BookTypeID')
                ->constrained('tblBookType', 'BookTypeID');
            $table->date('PublishDate')->nullable();
            $table->unsignedInteger('NumOfPages')->nullable();
            $table->unsignedInteger('NumOfCopies')->default(0);
            $table->string('Edition')->nullable();
            $table->string('Publisher')->nullable();
            $table->string('BookSource')->nullable();
            $table->text('Remark')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblBook');
    }
};