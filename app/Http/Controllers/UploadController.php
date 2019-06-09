<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;

class UploadController extends Controller
{
    public function index()

    {

        return view('upload');

    }

  

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */
    public function link(Request $request)

    {

        

        $imageTempName = tempnam(sys_get_temp_dir(), 'image-from-ariesocr');
        file_put_contents($imageTempName, file_get_contents($request->image_url));


        return $this->ocr($imageTempName);
        

    }


    public function upload()

    {

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

  

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

  

        request()->image->move(public_path('images'), $imageName);

        return $this->ocr(public_path('images').'/' . $imageName);
         
        /* return back()

            ->with('success','You have successfully upload image.')

            ->with('image',$imageName)

            ->with('result', $text);

            */

    }


    public function ocr($url) {


        
        $tesseract = new TesseractOCR($url);
        $text = $tesseract->whitelist(range('A', 'Z'), range(0, 9), '-')
        ->run();

        return response()->json(['status' => 'success', 'value' => $text]);
    
    }
}
