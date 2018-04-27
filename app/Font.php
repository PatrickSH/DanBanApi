<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Organization;
use App\FileType;

class Font extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'font', 'organization_id',
        'user_id'
    ];

    protected $table = "fonts";

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class,'organization_id');
    }

}