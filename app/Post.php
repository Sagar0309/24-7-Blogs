<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

use GrahamCampbell\Markdown\Facades\Markdown;

use App\Tag;


class Post extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['published_at'];
    
    protected $fillable=['title','slug','excerpt','body','published_at','category_id','view_count','image'];

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function scopePopular($query){
        return $query->orderBy('view_count', 'desc');
    }

    public function getImageurlAttribute($value){
        $imageUrl="";
        if(!is_null($this->image)){
            $imagePath=public_path()."/img/".$this->image;
            if(file_exists($imagePath)) $imageUrl = asset("public/img/". $this->image);
        }
        return $imageUrl;
    }

    public function getDateAttribute($value){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function scopeLatestFirst($quary){
        return $quary->orderBy('created_at','desc');
    }

    public function scopePublished($quary){
        return $quary->where("published_at","<=", Carbon::now());
    }

    public function scopeScheduled($quary){
        return $quary->where("published_at",">", Carbon::now());
    }

    public function scopeDraft($quary){
        return $quary->whereNull("published_at");
    }

    public function getBodyHtmlAttribute($value){
        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL ;
    }

    public function getExcerptHtmlAttribute($value){
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : NULL ;
    }

    public function dateFormatted($showTimes = false){
        $format="d/m/y";
        if($showTimes) $format=$format."H:i:s";
        return $this->created_at->format($format);
    }

    public function publicationLabel(){
        if(! $this->published_at){
            return '<span class="label label-warning">Draft</span>';
        }
        elseif($this->published_at && $this->published_at->isFuture()){
            return '<span class="label label-info">Schedule</span>';
        }
        else{
            return '<span class="label label-success">Published</span>';
        }
    }

    public function setPublishedAtAttribute($value){
        $this->attributes['published_at']=$value ?:NULL;
    }

    public function createTags($tagString)
    {
    $tags = explode(",", $tagString);
    $tagIds = [];
 
    foreach ($tags as $tag) 
    {        
        $newTag = Tag::firstOrCreate([
            'name' => trim($tag),
            'slug' => str_slug($tag)
        ]);
        $newTag->save();  
 
        $tagIds[] = $newTag->id;
    }
    //$this->tags()->sync($tagIds);
    $this->tags()->detach();
    $this->tags()->attach($tagIds);
    }

    // public function setViewCountAttribute($value){
    //     $this->attributes['view_count']=$value ?: 0 ;
    // }
    
}
