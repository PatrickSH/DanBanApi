<?php
namespace App\DanBan;

use Mockery\Exception;

class Directory{

    protected $type;
    protected $id;
    protected $file;
    protected $name;
    protected $path;

    public function __construct()
    {
        $this->storage_path = storage_path()."/";
    }

    private function createFileName()
    {
        return str_random(40).rand(1,1000000);
    }

    public function handlePrivateDirCreation( $type, $id, $tmpFile, $name )
    {
        $path = $this->storage_path.$type."/".$id;
        $this->type = $type;
        $this->id = $id;
        $this->name = $this->createFileName().$name;
        if(!file_exists($path)){
            if(mkdir($path)){ //Dir is created return path
                $this->file = $tmpFile;
                $this->path = $path;
                return $this;
            }else{ //Dir did not get created
                throw new Exception("Could not create directory for path".$path);
            }
        }else{ //Dir already exists return path
            $this->file = $tmpFile;
            $this->path = $path;
            return $this;
        }
    }

    public function addFileToDir()
    {
        try{
            //\Image::make($this->file)->save($this->path."/".$this->name);
            move_uploaded_file($this->file,$this->path."/".$this->name);
            return $this->path."/".$this->name;
        }catch (Exception $e){
            throw new Exception("Could not save file");
        }

    }

}