<?php

namespace App\Eloquent\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteImage extends Model
{
    protected $table = 'site_images';

    protected $fillable = [
        'page', 'image'
    ];


    public function getURL(){
        return Storage::url('public/site_images/'.$this->image);
    }
}
