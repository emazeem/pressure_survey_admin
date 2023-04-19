<?php

use Illuminate\Support\Facades\File as F;

function getFileContent($fileContent){


    //explode with next line
    $fileContents = preg_split('/\r\n|\r|\n/', $fileContent);
    $fileData=[];
    foreach ($fileContents as $content){
        //getting first word
        $first=strstr($content, ' ', true);
        //get last word
        $last = strrchr($content, ' ');
        if ($last!== false) {
            $last = substr($last, 1);
        }
        $address=str_replace([$first,$last],null,$content);

        $needle='0000';
        $position = strpos($address, $needle);

        if ($position !== false) {
            // Remove the substring after the needle
            $address = strstr($address, $needle, true); // Get the part of the string before the needle
            $address = str_replace($address . $needle, "", $address); // Remove the part of the string after the needle
        }
        $address=trim(preg_replace('/\s+/', ' ', $address));
        $fileData[]=[
            'meter'=>$first,
            'address'=>$address,
            'other'=>$last
        ];
    }
    return $fileData;
}
function getFileContents($path,$id){
    $fileData=[];

    foreach (F::lines($path) as $content) {
            //getting first word
            $first=strstr($content, ' ', true);
            //get last word
            $last = strrchr($content, ' ');
            if ($last!== false) {
                $last = substr($last, 1);
            }
            $address=str_replace([$first,$last],null,$content);

            $needle='0000';
            $position = strpos($address, $needle);

            if ($position !== false) {
                // Remove the substring after the needle
                $address = strstr($address, $needle, true); // Get the part of the string before the needle
                $address = str_replace($address . $needle, "", $address); // Remove the part of the string after the needle
            }
            $address=trim(preg_replace('/\s+/', ' ', $address));



            $address=substr($first,28).' '.$address;
            $first=substr($first,0,28);

            if ($first!=0 || $address !=null){
                $content=new \App\Models\FileData();
                $content->file_id=$id;
                $content->meter=$first;
                $content->address=$address;
                $content->save();
            }
    }

    return true;
}

function load_styles($files)
{
    $files = explode(',', $files);
    for ($i = 0; $i < count($files); $i++) {
        $version = (str_contains($files[$i], '?')) ? '?v=' . time() : '';
        $files[$i] = str_replace("?", "", $files[$i]);
        $file_url = load_file_url($files[$i], 'css') . $version;
        echo "<link href='{$file_url}' rel='stylesheet'>";
    }
}

function load_file_url($file, $type)
{
    $base_url = URL::to('/main-assets');
    $file_url = $base_url . '/' . $type . '/' . $file . '.' . $type;
    return $file_url;
}


function load_scripts($files)
{
    $files = explode(',', $files);
    for ($i = 0; $i < count($files); $i++) {
        $file_url = load_file_url($files[$i], 'js');
        echo "<script src='{$file_url}'></script>";
    }
}
