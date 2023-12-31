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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('password');
			$table->string('email');
			$table->string('contact');
			$table->string('main_profession');
			$table->string('photo');
			$table->text('about');
			$table->text('education');
			$table->text('practice');
			$table->text('practice_in_years');
			$table->text('residency');
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
