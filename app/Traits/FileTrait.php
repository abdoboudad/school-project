<?php


namespace App\Traits;

use Illuminate\Http\Request;

trait FileTrait
{
    public function getData(Request $request,$namefile){
        if($request->file('thumbnail') && $namefile == 'thumbnail'){
            return $request->file('thumbnail')->store($namefile,'files');
        }
        if($request->file('photo') && $namefile == 'imgs'){
            return $request->file('photo')->store($namefile,'files');
        }
        if($request->file('file') && $namefile == 'docs'){
            
            $filesarray = [];
            foreach ($request->file('file') as $file) {
                $filename = $file->getClientOriginalName();
                $path = $file->store($namefile,'files');
                // Save the file record to the database
                $filesarray[] = $path;
    
                // Move the uploaded file to a desired storage location
            }
            return $filesarray;
        }
    }
}