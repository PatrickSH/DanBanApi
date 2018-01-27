<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Organization;
use App\FileType;

class File extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_type_id', 'organization_id',
        'user_id','is_in_use',
        'file_path'
    ];

    protected $table = "files";

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class,'organization_id');
    }

    public function type()
    {
        return $this->belongsTo(FileType::class,'file_type_id');
    }

}