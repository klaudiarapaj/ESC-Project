<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToFollowersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->foreignId('following_id')->constrained('users')->onDelete('cascade');
          
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->dropColumn(['following_id']);
        });
    }
};