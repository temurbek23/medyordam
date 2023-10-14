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
        Schema::create('first_aids', function (Blueprint $table) {
            $table->id();
			$table->string('case');
			$table->string('photo');
			$table->text('treatment');
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('first_aids');
    }
};
