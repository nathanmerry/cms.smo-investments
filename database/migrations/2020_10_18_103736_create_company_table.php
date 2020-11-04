<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string("interestrates")->nullable();
            $table->string("legal")->nullable();
            $table->string("min_la")->nullable();
            $table->string("max_la")->nullable();
            $table->string("min_lt")->nullable();
            $table->string("max_lt")->nullable();
            $table->string("apr")->nullable();
            $table->string("rep_example")->nullable();
            $table->string("credit_report")->nullable();
            $table->string("increments")->nullable();
            $table->string("terms")->nullable();
            $table->string("Footer_Text")->nullable();
            $table->string("Warning")->nullable();
            $table->string("company_name")->nullable();
            $table->string("company_number")->nullable();
            $table->string("company_address")->nullable();
            $table->string("fca_number")->nullable();
            $table->string("ico_number")->nullable();
            $table->string("homepage_legal_block")->nullable();
            $table->string("warning_block_text")->nullable();
            $table->string("terms_url")->nullable();
            $table->string("home_step_one")->nullable();
            $table->string("home_step_two")->nullable();
            $table->string("home_step_three")->nullable();
            $table->string("home_ctas")->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
