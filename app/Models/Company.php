<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    protected $table = 'company';
    public $timestamps = false;
    protected $fillable = [
        "id",
        "interestrates",
        "legal",
        "min_la",
        "max_la",
        "min_lt",
        "max_lt",
        "apr",
        "rep_example",
        "credit_report",
        "increments",
        "terms",
        "Footer_Text",
        "Warning",
        "company_name",
        "company_number",
        "company_address",
        "fca_number",
        "ico_number",
        "homepage_legal_block",
        "warning_block_text",
        "terms_url",
        "home_step_one",
        "home_step_two",
        "home_step_three",
        "home_ctas"
    ];
}
