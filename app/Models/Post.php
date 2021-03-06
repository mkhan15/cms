<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['title','description','content','image','published_at','category_id'];

    public function deleteImage()
    {

        Storage::delete(post->image);
    }

    public function category()
    {

        return  $this->belongsTo('App\Models\Category');
    }

 public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');

    }

    public function hasTag($tagId){

        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }
}
