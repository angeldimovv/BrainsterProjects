<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'company_info';

    protected $fillable = [
        'hero_image',
        'social_media',
        'hq_address',
        'employees',
    ];

    protected function casts(): array
    {
        return [
            'social_media' => 'array',
            'employees' => 'array',
        ];
    }
}
