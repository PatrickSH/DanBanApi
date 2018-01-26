<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MembershipType;

class MembershipTypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param Request $request
     * @return mixed json on success 0 on fail
     */
    public function store(Request $request)
    {
        $created = json_decode(MembershipType::create($request->all()));
        return (isset($created->id) && $created->id > 0) ? $created : 0;
    }

    /**
     * @param Request $request
     * @return json
     */
    public function get(Request $request)
    {
        if(!$request->get('id')){
            $data = json_encode(MembershipType::all());
        }else{
            $data = json_encode(MembershipType::where('id',$request->get('id'))->get());
        }
        return $data;
    }

    /**
     * @param Request $request
     * @return json
     */
    public function update(Request $request)
    {
        $data = json_decode(MembershipType::find($request->get('id'))->update(['type' => $request->get('type')]));
    }
}
