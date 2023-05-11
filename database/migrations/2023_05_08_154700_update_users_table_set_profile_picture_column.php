<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Update users table to set default profile picture
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_picture')->default('images/default_pfp.png')->change();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Revert changes made in the up() method
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_picture')->default(null)->change();
        });
    }
};
