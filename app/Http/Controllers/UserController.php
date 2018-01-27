<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use App\MembershipType;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * @param Request $request
     * @return mixed json on success 0 on fail
     */
    public function store(Request $request)
    {
        $created = json_decode(User::create($request->only(['organization_id','username','email','password'])));
        return (isset($created->id) && $created->id > 0) ? $created : 0;
    }

    /**
     * @param Request $request
     * @return json
     */
    public function get(Request $request)
    {
        if(!$request->get('id')){
            $data = $this->user;
        }else{
            $data = $this->user->where('id',$request->get('id'));
        }

        if($request->get('with_organization')){
            $data = $data->with('organization');
        }



        return json_encode($data->get());
    }

    /**
     * @param Request $request
     * @return json
     */
    public function update(Request $request)
    {
        $data = json_decode(User::find($request->get('id'))->update($request->only(['organization_id','username','email','password'])));

        return $data;
    }
}
