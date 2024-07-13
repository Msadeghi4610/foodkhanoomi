<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function upload()
    {
        return view('silder.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'mimes:jpeg,png,jpg'],
        ]);
        $file = $request->file('photo');
        $name = now()->format('Ydm_Him') . '.' . $file->getClientOriginalExtension();
        $file->move('Image', $name);
        Slider::create([
            'name'=>$name,
        ]);
        return redirect('/Admin/slider')->with('success','آپلود تصویر اسلایدر با موفقیت انجام شد');
    }

    public function del($idslide)
    {
        $slider=Slider::findorfail($idslide);
        if (is_null($slider)){
            abort('404');
        }else{
            File::delete(public_path('/image/'.$slider->name));
            $slider->delete();
            return redirect('/Admin/slider')->with('delete','تصویر مورد نظر با موفقیت حذف شد');
        }
    }
}
