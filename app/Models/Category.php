<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',       
       
    ];
     public function getRouteKeyName()
    {
        return 'name';
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
