<?php
namespace App\DanBan;

use Mockery\Exception;

class Directory{

    protected $type;
    protected $id;
    protected $file;
    protected $name;
    protected $path;
    protected $url;

    protected $currentFolder;

    public function __construct()
    {
        $this->storage_path = getcwd()."/";
        $this->url = "http://api.danban.dev.cc/";
    }

    private function createFileName()
    {
        return str_random(40).rand(1,1000000);
    }

    /**
     * Obsolete should be replaced
     * @return string
     */
    public function handlePrivateDirCreation( $type, $id, $tmpFile, $name )
    {
        $path = $this->storage_path.$type."/".$id;
        $this->url = $this->url.$type."/".$id;

        $this->type = $type;
        $this->id = $id;
        $this->name = $this->createFileName().$name;
        if(!file_exists($path)){
            if(mkdir($path)){ //Dir is created return path
                $this->file = $tmpFile;
                $this->path = $path;
                $this->currentFolder = $path;
                return $this;
            }else{ //Dir did not get created
                throw new Exception("Could not create directory for path".$path);
            }
        }else{ //Dir already exists return path
            $this->file = $tmpFile;
            $this->path = $path;
            $this->currentFolder = $path;
            return $this;
        }
    }

    /**
     * Obsolete should be replaced
     * @return string
     */
    public function addFileToDir()
    {
        try{
            //\Image::make($this->file)->save($this->path."/".$this->name);
            $path = $this->path."/".$this->name;
            move_uploaded_file($this->file,$path);
            return $this->url."/".$this->name;
        }catch (Exception $e){
            throw new Exception("Could not save file");
        }

    }

    public function addNewFolderToPrivateDir($type, $id, $folderName)
    {
        $path = $this->storage_path.$type."/".$id."/".$folderName;
        if(mkdir($path)){ //Dir is created return path
            $this->currentFolder = $path;
            return $this;
        }else{ //Dir did not get created
            throw new Exception("Could not create directory for path".$path);
        }
    }

    public function createTextFile($fileName,$extension,$text)
    {
        $file = fopen($this->currentFolder."/".$fileName.".".$extension, "ab+");
        fwrite($file,$text);
        fclose($file);
    }



}