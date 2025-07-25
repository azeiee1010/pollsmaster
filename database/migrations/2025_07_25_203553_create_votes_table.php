<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->constrained()->onDelete('cascade');
            $table->foreignId('option_id')->constrained()->onDelete('cascade'); // Reference to options table
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable for anonymous users
            $table->ipAddress('voter_ip')->nullable();
            $table->timestamps();

            // One vote per IP per poll to prevent duplicate votes
            $table->unique(['poll_id', 'voter_ip']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
