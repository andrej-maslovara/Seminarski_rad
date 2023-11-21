<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = 
    ['page_id', 'content', 'position', 'color', 'font_size', 'deleted'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function updateContent($content)
    {
        $this->update(['content' => $content]);
    }
}