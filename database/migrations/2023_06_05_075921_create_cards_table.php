<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('monster_attribute_id')->nullable()->unsigned()->constrained()->cascadeOnDelete();
            $table->integer('level')->nullable();
            $table->foreignId('photo_id')->unsigned()->constrained()->cascadeOnDelete();
            $table->foreignId('monster_type_id')->unsigned()->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('monster_class_id')->unsigned()->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('pendulum')->nullable();
            $table->foreignId('monster_special_type_id')->unsigned()->nullable()->constrained()->cascadeOnDelete();
            $table->string('description')->nullable()       ;
            $table->string('atk')->nullable();
            $table->string('def')->nullable();
            $table->foreignId('spell_type_id')->unsigned()->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('trap_type_id')->unsigned()->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('card_type_id')->unsigned()->nullable()->constrained()->cascadeOnDelete();
            $table->decimal('price');
            $table->string('product_type')->default('card');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
};
