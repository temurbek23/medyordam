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
        Schema::create('call_histories', function (Blueprint $table) {
            $table->id();
			$table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
			$table->foreignId('patient_id')->constrained()->cascadeOnDelete();
			$table->unsignedBigInteger('duration');
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('call_histories');
    }
};
