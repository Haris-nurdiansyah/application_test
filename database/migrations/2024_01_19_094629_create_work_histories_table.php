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
        Schema::create('work_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biodata_id')
                ->references('id')
                ->on('biodatas')
                ->cascadeOnDelete();
            $table->string('company_name');
            $table->string('last_position');
            $table->bigInteger('last_salary')->default(0);
            $table->date('work_date');
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
        Schema::dropIfExists('work_histories');
    }
};
