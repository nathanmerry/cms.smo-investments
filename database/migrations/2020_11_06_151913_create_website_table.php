<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website', function (Blueprint $table) {
            $table->id();
            $table->string("website_slug")->unique()->nullable();
            $table->string("website_name")->unique()->nullable();
            $table->string("website_address")->unique()->nullable();
            $table->string("website_short_address")->nullable();
            $table->integer("company")->nullable();
            $table->string("logo_url")->nullable();
            $table->string("logo_filename")->nullable();
            $table->string("brand_colour")->nullable();
            $table->string("header_colour")->nullable();
            $table->string("header_font_colour")->nullable();
            $table->string("footer_background_colour")->nullable();
            $table->string("footer_font_colour")->nullable();
            $table->string("second_colour")->nullable();
            $table->string("homepage_block_colour")->nullable();
            $table->string("warning_block")->nullable();
            $table->string("homepage_heading_colour")->nullable();
            $table->string("homepage_span_colour")->nullable();
            $table->string("homepage_reasons_colour")->nullable();
            $table->string("homepage_block_border")->nullable();
            $table->string("home_cta_one")->nullable();
            $table->string("home_cta_two")->nullable();
            $table->string("header_font_colour_hover")->nullable();
            $table->string("home_cta_three")->nullable();
            $table->string("home_image_one")->nullable();
            $table->string("home_image_two")->nullable();
            $table->string("home_image_three")->nullable();
            $table->string("h1")->nullable();
            $table->string("h2c")->nullable();
            $table->string("h3c")->nullable();
            $table->string("p")->nullable();
            $table->string("button_colour")->nullable();
            $table->string("button_colour_border")->nullable();
            $table->string("button_colour_hover")->nullable();
            $table->string("slider_colour")->nullable();
            $table->string("loan_information_colour")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website');
    }
}
