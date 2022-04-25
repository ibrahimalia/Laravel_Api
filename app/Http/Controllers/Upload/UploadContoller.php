<?php

namespace App\Http\Controllers\Upload;
use Image;
use App\Http\Controllers\Controller;
use App\Jobs\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadContoller extends Controller
{
    //
    public function upload(Request $request){
        //validation
        $this->validate($request,[
            'image' => ['required','mimes:png,jpg,jpeg','max:5000']
        ]);
        // get image form request
        $image= $request->file('image');

        $image_path = $image->getPathName() ;
        //get file name and replace space in name with underscore
        $fileName= time()."_".preg_replace('/\s+/','_',strtolower($image->getClientOriginalName()));
        $tmp = $image->storeAs('uploads/original',$fileName,'tmp');
        $design=Auth::user()->designs()->create([
                'image' =>$fileName,
                'disk'=>config('site.upload_disk')
            ]);
            $this->dispatch(new UploadImage($design));
            return response()->json(['data'=>$design],200);
            
        }
    }
    
