<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function dates(): HasMany
    {
        return $this->hasMany(AgendaDate::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(AgendaItem::class);
    }
}
