<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jb_account_activity_logs', function (Blueprint $table) {
            $table->string('ip_address', 39)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jb_account_activity_logs', function (Blueprint $table) {
            $table->string('ip_address', 25)->nullable()->change();
        });
    }
};
