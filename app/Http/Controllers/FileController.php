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


    public function createIndexFile(Request $request)
    {
        $random = str_random(10);
        $folder = $this->directory->addNewFolderToPrivateDir("user",1,$random);
        $folder->createTextFile("index","html",$request->get('code'));

        if($request->get('css_type') && $request->get('css_type') == "document") { //We want to use CSS document
            $folder->createTextFile("style","css",$request->get('css'));
        }

        if($request->get('script')){
            $folder->createTextFile("script","js",$request->get('script'));
        }
    }


    public function createCss(Request $request)
    {
        if($request->get('css_type') == "document"){ //We want to use CSS document

        }else{

        }

        if($request->get('organization_id')){

        }else{

        }
    }

}
