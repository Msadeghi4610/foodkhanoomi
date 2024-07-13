<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show()
    {
        $datas=Category::all();
        return view('category.category',[
            'datas'=>$datas,
        ]);
    }
    public function store(Request $request){
       $request->validate([
           'name'=>['required'],
       ]);
       Category::create([
           'name'=>$request->name,
       ]);
      return redirect()->back();
    }

    public function delete($id)
    {
        $category=Category::findorfail($id);
        $category->delete();
        return back();
    }

    public function edit($id)
    {
       $cat=Category::findorfail($id);
       if (is_null($cat)){
           abort('404');
       }
       return view('category.edit',[
           'category'=>$cat,
       ]);
    }

    public function update(Request $request,$id)
    {
      $request->validate([
          'name_cat'=>['required'],
      ]);
      $category=Category::findorfail($id);
      if (is_null($category)){
          abort('404');
      }
      $category->update([
          'name'=>$request->name_cat,
      ]);

      return redirect('/Admin/category');
    }
}
