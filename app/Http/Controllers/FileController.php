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
            $path = $this->directory->
            handlePrivateDirCreation("organization",$request->get('organization_id'),$_FILES['file']['tmp_name'],$_FILES['file']['name'])->
            addFileToDir();
        }else{
            $path = $this->directory->
            handlePrivateDirCreation("user",$request->get('user_id'),$_FILES['file']['tmp_name'],$_FILES['file']['name'])->
            addFileToDir();
        }

        $data['file_path'] = $path;

        $created = json_decode(File::create($data));
        return (isset($created->id) && $created->id > 0) ? $path : 0;
    }

}
