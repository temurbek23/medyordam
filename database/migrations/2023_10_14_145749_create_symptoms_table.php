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
        Schema::create('symptoms', function (Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('symptoms');
    }
};
