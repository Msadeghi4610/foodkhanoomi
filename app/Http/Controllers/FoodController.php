<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FoodController extends Controller
{
    public function add()
    {
        return view('food.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'datelist' => ['required'],
            'price' => ['required'],
            'category' => ['required'],
            'photo' => ['required', 'mimes:jpeg,png,jpg'],
        ]);
        $file = $request->file('photo');
        $name = now()->format('Ydm_Him') . '.' . $file->getClientOriginalExtension();
        $file->move('Image', $name);
        Food::create([
            'name' => $request->name,
            'details' => $request->datelist,
            'price' => $request->price,
            'photo' => $name,
            'category_id' => $request->category,
        ]);
        return redirect('/');
    }

    public function list()
    {
        return view('food.list');
    }

    public function edit($id)
    {
        $food=Food::findorfail($id);
        if (is_null($food)){
            return abort('404');
        }else{
            return view('food.edit',[
                'food'=>$food,
            ]);
        }
    }

    public function update(Request $request,$id)
    {
        $food=Food::findorfail($id);
        if (is_null($food)){
            return abort('404');
        }else{
            $request->validate([
                'name' => ['required', 'min:3', 'max:30'],
                'datelist' => ['required'],
                'price' => ['required'],
                'category' => ['required'],
            ]);
            $food->update([
                'name' => $request->name,
                'details' => $request->datelist,
                'price' => $request->price,
                'category_id' => $request->category,
            ]);
            if ($request->file('photo')){
                $request->validate([
                    'photo' => ['mimes:jpeg,png,jpg'],
                ]);
                $findphoto=Food::where('id',$id)->first();
                File::delete(public_path('/image/'.$findphoto->photo));
                $file = $request->file('photo');
                $name = now()->format('Ymd_Him') . '.' . $file->getClientOriginalExtension();
                $file->move('Image', $name);
                $food->update([
                    'photo'=>$name,
                ]);
            }
            return view('food.list');

        }

    }

    public function delete($id)
    {
        $food=Food::findorfail($id);
        if (is_null($food)){
            return abort('404');
        }else{
            File::delete(public_path('/image/'.$food->photo));
            $food->delete();
            return view('food.list');
        }
    }
}
