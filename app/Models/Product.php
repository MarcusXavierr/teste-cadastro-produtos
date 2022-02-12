<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'tag';
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
