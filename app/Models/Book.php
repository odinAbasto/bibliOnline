<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','author_id','year','file_path','cover_path','synopsis'];

    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }



}
