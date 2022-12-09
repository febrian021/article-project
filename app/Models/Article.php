<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'article_image',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $appends = ['image_full'];

    public function getImageFullAttribute(){
        $data = env('APP_URL').'/'.'storage/'.$this->article_image;
        return $data;
    }
}
