<?php
namespace App\DanBan;

use Mockery\Exception;

class Directory{

    public function __construct()
    {

    }

    public function handlePrivateDirCreation( $type, $id )
    {
        $path = storage_path()."/".$type."/".$id;
        if(!file_exists($path)){
            if(mkdir($path)){ //Dir is created return path
                return $path;
            }else{ //Dir did not get created
                throw new Exception("Could not create directory for path".$path);
            }
        }else{ //Dir already exists return path
            return $path;
        }
    }

}