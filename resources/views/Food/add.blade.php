@extends('layout.app')
@section('content')
    <div id="FoodAdd"
         class="col-10 col-lg-6 mx-auto my-5 py-5 px-3 border border-2 border-secondary border-opacity-25 rounded-1 shadow-lg ">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                {{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
        <form action="{{url('/Admin/food/store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">نام غذا را وارد نمائید</label>
                <input type="tel" name="name" class="form-control fw-700 text-start {{($errors->has('name')? 'border-danger':'')}}" value="{{old('name')}}">
            </div>
            <div class="mb-3">
                <label for="datelist" class="form-label">جزئیات غذا را وارد نمائید</label>
                <input type="tel" name="datelist"  class="form-control f-vazir text-start {{($errors->has('datelist')? 'border-danger':'')}}" value="{{old('datelist')}}">
            </div>
            <label for="price" class="form-label">قیمت غذا را وارد نمائید</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control f-vazir {{($errors->has('price')? 'border-danger':'')}}" name="price" value="{{old('price')}}">
                <span class="input-group-text font_bold {{($errors->has('price')? 'border-danger':'')}}" id="basic-addon1">تومان</span>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">دسته بندی غذا را انتخاب نمائید</label>
                <select name="category" class="form-select fw-700 {{($errors->has('category')? 'border-danger':'')}}">
                    <option value=""></option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">تصویر غذا را وارد نمائید</label>
                <input type="file" name="photo" value="{{old('photo')}}" class="form-control fw-700 text-start {{($errors->has('photo')? 'border-danger':'')}}">
            </div>
            <div class="mb-3 d-flex flex-row justify-content-start">
                <button type="submit" class="btn btn-success fw-700 px-5 py-2 w-25 me-3">ثبت</button>
            </div>
        </form>
    </div>
@endsection
