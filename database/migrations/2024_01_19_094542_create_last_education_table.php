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
        Schema::create('last_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biodata_id')
                ->references('id')
                ->on('biodatas')
                ->cascadeOnDelete();
            $table->string('education_namme');
            $table->string('institution');
            $table->string('major');
            $table->date('graduation_date');
            $table->double('ipk')->default(0);
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
        Schema::dropIfExists('last_education');
    }
};
