<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use App\MembershipType;

class OrganizationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->organization = new Organization();
    }

    /**
     * @param Request $request
     * @return mixed json on success 0 on fail
     */
    public function store(Request $request)
    {
        $created = json_decode(Organization::create($request->all()));
        return (isset($created->id) && $created->id > 0) ? $created : 0;
    }

    /**
     * @param Request $request
     * @return json
     */
    public function get(Request $request)
    {
        if(!$request->get('id')){
            $data = $this->organization;
        }else{
            $data = $this->organization->where('id',$request->get('id'));
        }

        if($request->get('with_membership')){
            $data = $data->with('withMembershipType');
        }



        return json_encode($data->get());
    }

    /**
     * @param Request $request
     * @return json
     */
    public function update(Request $request)
    {
        $data = json_decode(Organization::find($request->get('id'))->update($request->except(['id'])));

        return $data;
    }
}
