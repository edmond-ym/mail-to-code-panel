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
        Schema::create('draft_messages', function (Blueprint $table) {
            $table->string('id', 10)->unique()->primary();
            $table->string("sender_public_code");
            $table->longText("receiver_list");
            $table->longText("message");
            $table->longText("options")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('draft_message');
    }
};
