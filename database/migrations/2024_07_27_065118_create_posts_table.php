<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.column:
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('titleart')->nullable();
            $table->text('body')->nullable();
            $table->string('imgart')->nullable();
            $table->string('likeart')->nullable();
            $table->string('noteart')->nullable();
            $table->string('linknote')->nullable();
            $table->string('fileVid')->nullable();
            $table->string('fileAud')->nullable();
            $table->string('link_video')->nullable();
            $table->string('books')->nullable();
            $table->foreignId('idsection');
            $table->integer('userid');
            $table->integer('teypsection');
            $table->foreign('idsection')->references('id')->on('sections');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
