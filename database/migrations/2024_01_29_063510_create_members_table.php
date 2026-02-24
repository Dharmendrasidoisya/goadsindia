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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('division_id');
            $table->string('name');
            $table->string('fathername')->nullable();
            $table->string('photo')->nullable();
            $table->string('dob')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('acno')->nullable();
            $table->string('aadharno')->nullable();
            $table->string('workexp')->nullable();
            
            $table->enum('role',['member'])->default('member');
            $table->enum('status',['active','inactive'])->default('active'); 
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
};
