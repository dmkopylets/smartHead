<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class File extends BaseMedia
{
    protected $table = 'files';
}
