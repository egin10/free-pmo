<?php

namespace App\Entities\Projects;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['fileable_id', 'fileable_type', 'type_id', 'filename', 'title', 'description'];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function project()
    {
        return $this->morphTo('fileable', Project::class);
    }

    public function getSize()
    {
        return $this->fileExists() ? \Storage::size('public/files/'.$this->filename) : 0;
    }

    public function fileExists()
    {
        return \Storage::exists('public/files/'.$this->filename);
    }
}