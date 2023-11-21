<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'raw_code', 'content'];

    public function elements()
    {
        return $this->hasMany(Element::class);
    }
}