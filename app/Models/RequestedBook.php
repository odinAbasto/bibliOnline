<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'url'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
