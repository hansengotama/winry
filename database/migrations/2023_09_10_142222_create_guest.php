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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guest_group_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('wishes_icon_type')->nullable();
            $table->string('invitation_url')->unique();
            $table->integer('max_attendance');
            $table->integer('number_of_attendance')->nullable();
            $table->longText('wishes')->nullable();
            $table->boolean('is_show_wishes')->default(true);
            $table->boolean('is_attend')->nullable();
            $table->timestamps();

            $table->foreign('guest_group_id')->references('id')->on('guest_groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
