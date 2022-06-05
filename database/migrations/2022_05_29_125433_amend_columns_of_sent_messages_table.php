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
        Schema::table('sent_messages', function (Blueprint $table) {

            $table->dropColumn(['receiver_public_code', 'receiver_private_code']);
            $table->longText("receiver_list")->after('sender_public_code');
            $table->longText("options")->nullable()->after('message');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
