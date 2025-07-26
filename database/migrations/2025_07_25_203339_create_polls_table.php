<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

            $table->string('question');
            $table->text('description')->nullable();

            $table->boolean('is_anonymous')->default(false); // Allow anonymous votes
            $table->boolean('is_closed')->default(false);    // Manually closed by creator

            $table->string('public_id')->unique();           // For public sharing like /polls/{public_id}/public

            $table->timestamp('expires_at')->nullable();     // Optional expiry for poll

            $table->timestamps();
            $table->softDeletes(); // In case we want to restore deleted polls
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polls');
    }
}
