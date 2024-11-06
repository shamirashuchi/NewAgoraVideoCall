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
        Schema::table('job_tag_column', function (Blueprint $table) {
            $table->json('job_tag')->default(json_encode([]))->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_tag_column', function (Blueprint $table) {
            $table->json('job_tag')->nullable(false)->change();
        });
    }
};
