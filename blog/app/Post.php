<?php

namespace App;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [ 'img_url', 'user_id', 'post_id', 'title', 'body'];
    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }

    public function addComment($body)
    {
    	$this->comments()->create([
            'user_id'=>$request['user_id'],
            'post_id'=>$request['post_id'],
            'body'=>$request['body']
        ]);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function scopeFilter($query, $filters)
    {
        if($month=$filters['month']){
        $query->whereMonth('created_at',Carbon::parse($month)->month);
        }

        if($year=$filters['year']){
        $query->whereYear('created_at',$year);
        }
    }

    public static function archives()
    {
         return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    public function tags()
    {
       return $this->belongsToMany(Tag::class);
    }
}
