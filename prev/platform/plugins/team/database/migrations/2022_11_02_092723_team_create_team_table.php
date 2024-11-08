<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->string('socials')->nullable();
            $table->string('status', 60)->default('published');

            $table->timestamps();
        });

        Schema::create('teams_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->integer('teams_id');
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('location')->nullable();

            $table->primary(['lang_code', 'teams_id'], 'teams_translations_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
        Schema::dropIfExists('teams_translations');
    }
};
