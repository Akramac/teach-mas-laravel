<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;
    protected $table = 'footer';

    protected $fillable = [
        'title_1',
        'title_2',
        'title_3',
        'title_4',
        'sub_1_title_1',
        'sub_1_title_2',
        'sub_1_title_3',
        'sub_2_title_1',
        'sub_2_title_2',
        'sub_2_title_3',
        'sub_3_title_1',
        'sub_3_title_2',
        'sub_3_title_3',
        'sub_4_title_1',
        'sub_4_title_2',
        'sub_4_title_3',
        'url_1_title_1',
        'url_1_title_2',
        'url_1_title_3',
        'url_2_title_1',
        'url_2_title_2',
        'url_2_title_3',
        'url_3_title_1',
        'url_3_title_2',
        'url_3_title_3',
        'url_4_title_1',
        'url_4_title_2',
        'url_4_title_3',
    ];

}
