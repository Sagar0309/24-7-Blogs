<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use GrahamCampbell\Markdown\Facades\Markdown;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','slug','bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function gravatar(){
        $email = $this->email ;
        $default = "https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png";
        $size = 100;

        return  "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }

    public function post(){
        return $this->hasMany(Post::class, 'author_id');
    } 

    public function getRouteKeyName(){
        return 'slug';
    }

    public function getBioHtmlAttribute($value){
        return $this->bio ? Markdown::convertToHtml(e($this->bio)) : NULL ;
    }

    public function getSlugforName($value){
        $slug = strtolower($value);
        $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);
        return $slug;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
