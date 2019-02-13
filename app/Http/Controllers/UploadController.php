<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function getForm()
    {
        return view('upload-form');
    }

    public function upload(Request $request)
    {
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                var_dump(1234);
                $f->move(storage_path('images'), time().'_'.$f->getClientOriginalName());
                //$f->move(public_path().'/images', date('dmY_Hi').'_'.$f->getClientOriginalName());
            }
        }
        return "Успех";
    }
}