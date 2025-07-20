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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("url");
            $table->string("title");
            $table->string("icon");
            $table->boolean("favorite")->default(false);
            $table->integer("readCount");
            $table
                ->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            // $table
            //     ->foreignId('user_id')
            //     ->constrained()
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
