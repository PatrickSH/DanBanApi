<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
    ];

    protected $table = "file_type";


}