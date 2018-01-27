<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\MembershipType;

class Organization extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'membership_type_id', 'name',
        'active'
    ];

    protected $table = "organization";

    public function withMembershipType()
    {
        return $this->belongsTo(MembershipType::class,'membership_type_id');
    }

}