<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website';

    protected $fillable = [
        'id',
        'website_slug',
        'company',
        "website_name",
        "website_address",
        "website_short_address",
        "brand_colour",
        "header_colour",
        "header_font_colour",
        "header_font_colour_hover",
        "footer_background_colour",
        "footer_font_colour",
        "second_colour",
        "homepage_block_colour",
        "warning_block",
        "homepage_heading_colour",
        "homepage_span_colour",
        "homepage_reasons_colour",
        "homepage_block_border",
        "home_cta_one",
        "home_cta_two",
        "home_cta_three",
        "home_image_one",
        "home_image_two",
        "home_image_three",
        "h1",
        "h2c",
        "h3c",
        "p",
        "button_colour",
        "button_colour_border",
        "button_colour_hover",
        "slider_colour",
        "loan_information_colour",
    ];

    public $timestamps = false;
}
