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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string("first name",100)->nullable();
            $table->string("last name",100)->nullable();
            $table->date("dob");
            $table->string("email",100)->unique();
            $table->string("phone",15);
            $table->char("gender")->comment("[m: Mele, f: Female]");
            $table->text("address");
            $table->string("city",100);
            $table->integer("pincode");
            $table->string("state",100);
            $table->string("country",100);
            $table->string("hobbies",200);
            $table->string("courses",200);
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
        Schema::dropIfExists('student');
    }
};
