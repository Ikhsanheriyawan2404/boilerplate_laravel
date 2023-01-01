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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('agreement_document');
            $table->string('npwp');
            $table->string('business_doc');
            $table->date('cutoff_date');
            $table->date('payroll_date');
            $table->date('join_date');
            $table->date('end_date');
            $table->string('name_pic');
            $table->string('phone_pic');
            $table->string('email_pic');
            $table->integer('working_days');
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
        Schema::dropIfExists('companies');
    }
};
