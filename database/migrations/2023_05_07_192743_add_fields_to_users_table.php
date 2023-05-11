<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('department')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('interests')->nullable();
            $table->text('bio')->nullable();
            $table->string('major')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('profile_picture')->default('resources/images/default_pfp.png');
            $table->enum('privacy', ['public', 'private'])->default('public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['department', 'birthdate', 'interests', 'bio', 'major', 'phonenumber', 'profile_picture', 'privacy']);
        });
    }
}