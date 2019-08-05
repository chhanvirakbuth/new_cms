<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    use SoftDeletes;

    protected $fillable=[
      'title','description','content','published_at','image','category_id'
    ];

    public function getImageAttribute($value)
   {
     if($value){
       if(Storage::exists($value)) {
          return 'storage/'.$value;
        }
     }
     return 'storage/images/blank.png';
   }

   public function deleteImage(){
     Storage::delete($this->image);
   }

   public function category(){
    return  $this->belongsTo('App\Category');
   }

   public function tags(){
     return $this->belongsToMany(Tag::class);
   }
// check if post has tags
   public function hasTag($tagId){
     return in_array($tagId, $this->tags->pluck('id')->toArray());
   }
}
