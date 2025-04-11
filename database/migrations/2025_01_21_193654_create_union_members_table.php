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
    Schema::create('union_members', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('union_id'); // Foreign key for the union
        $table->unsignedBigInteger('user_id'); // Foreign key for the user
        $table->enum('status', ['active', 'inactive'])->default('active'); // Track membership status
        $table->timestamps();

        // Foreign keys
        $table->foreign('union_id')->references('id')->on('unions')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('union_members');
    }
};
