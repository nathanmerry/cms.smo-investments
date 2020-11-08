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
            $table->text("legal")->nullable();
            $table->string("min_la")->nullable();
            $table->string("max_la")->nullable();
            $table->string("min_lt")->nullable();
            $table->string("max_lt")->nullable();
            $table->string("apr")->nullable();
            $table->text("rep_example")->nullable();
            $table->text("credit_report")->nullable();
            $table->text("increments")->nullable();
            $table->longText("terms")->nullable();
            $table->longText("Footer_Text")->nullable();
            $table->longText("Warning")->nullable();
            $table->text("company_name")->nullable();
            $table->text("company_number")->nullable();
            $table->text("company_address")->nullable();
            $table->text("fca_number")->nullable();
            $table->text("ico_number")->nullable();
            $table->text("homepage_legal_block")->nullable();
            $table->text("warning_block_text")->nullable();
            $table->text("terms_url")->nullable();
            $table->text("home_step_one")->nullable();
            $table->text("home_step_two")->nullable();
            $table->text("home_step_three")->nullable();
            $table->text("home_ctas")->nullable();
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
