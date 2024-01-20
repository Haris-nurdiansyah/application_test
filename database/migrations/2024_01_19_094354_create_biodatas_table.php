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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->string('position_applied');
            $table->string('name');
            $table->date('birth_date');
            $table->string('no_ktp');
            $table->enum('gender', ['L', 'P']);
            $table->string('golongan_darah');
            $table->string('religion');
            $table->string('status');
            $table->text('ktp_address');
            $table->text('address');
            $table->string('email');
            $table->string('no_telp');
            $table->string('related_person');
            $table->string('skills');
            $table->tinyInteger('job_placement_confirmation')->default(0);
            $table->bigInteger('salary_expecation')->default(0);
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
        Schema::dropIfExists('biodatas');
    }
};
