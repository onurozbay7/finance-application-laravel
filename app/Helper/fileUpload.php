<?php
namespace App\Helper;
use File;
use Image;

class fileUpload
{
    static function newUpload($name,$directory,$file,$type =0)
    {
        $dir = 'images/'.$directory.'/'.$name;
        if(!empty($file))
        {
            if(!File::exists($dir))
            {
                File::makeDirectory($dir,0755,true);
            }

            $filename = rand(1,90000).'.'.$file->getClientOriginalExtension();
            if($type == 0)
            {
                $path = $dir.'/'.$filename;
                Image::make($file->getRealPath())->save($path);
            }
            else
            {
                $path = $dir.'/';
                $file->move($path,$filename);

            }

            return $dir.'/'.$filename;

        }
        else
        {
            return "";
        }

    }

    static function changeUpload($name,$directory,$file,$type =0,$data,$field)
    {
        if(!empty($file))
        {
            $dir = 'images/'.$directory.'/'.$name;
            if(!File::exists($dir))
            {
                File::makeDirectory($dir,0755,true);
            }
            $filename = rand(1,900000).'.'.$file->getClientOriginalExtension();
            if($type == 0)
            {
                $path = $dir.'/'.$filename;
                Image::make($file->getRealPath())->save($path);
            }
            else
            {
                $path = $dir.'/';
                $file->move($path,$filename);
            }

            if(self::folderFounder($data[0][$field])!="") {
                File::deleteDirectory(public_path(self::folderFounder($data[0][$field])));
            }

            return $dir.'/'.$filename;
        }
        else
        {
            return $data[0][$field];

        }
    }

    static function folderFounder($filename)
    {
        $explode = explode('/',$filename);
        unset($explode[3]);
        return implode('/',$explode);
    }

    static function deleteDirectory($filepath){
        if(self::folderFounder($filepath)!=""){
            File::deleteDirectory(public_path(self::folderFounder($filepath)));
        }

    }

}
