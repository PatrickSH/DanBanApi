<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\FileType;
use App\DanBan\Directory;

class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->directory = new Directory();
    }

    /**
     * @param Request $request
     * @return mixed json on success 0 on fail
     */
    public function storeType(Request $request)
    {
        $created = json_decode(FileType::create($request->all()));
        return (isset($created->id) && $created->id > 0) ? $created : 0;
    }

    /**
     * @param Request $request
     * @return mixed json on success 0 on fail
     */
    public function storeFile(Request $request)
    {
        $data = $request->all();
        if($request->get('organization_id')){ //Is organization
            $path = $this->directory->handlePrivateDirCreation("organization",$request->get('organization_id'));
        }else{
            $path = $this->directory->handlePrivateDirCreation("user",$request->get('user_id'));
        }

        $data['file_path'] = $path;

        $created = json_decode(File::create($data));
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
