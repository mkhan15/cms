<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');

    }

    public function hasTag($tagId){

        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }
}
