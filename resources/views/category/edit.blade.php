@extends('layout.app')
@section('content')
    <div id="EditCategory"
         class="col-10 col-lg-6 mx-auto my-5 py-5 px-3 border border-2 border-secondary border-opacity-25 rounded-1 shadow-lg ">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                {{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
        <form action="/Admin/category/update/{{$category->id}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="mobile_user" class="form-label">نام جدید دسته بندی را وارد نمائید</label>
                <input type="text" name="name_cat" value="{{$category->name}}" class="form-control fw-700 text-start {{($errors->first('name_cat') ? 'border-danger' :'')}}">
            </div>
            <div class="mb-3 d-flex flex-row justify-content-start">
                <button type="submit" class="btn btn-success fw-700 px-5 py-2 w-25 me-3">ثبت</button>
            </div>
        </form>
    </div>
@endsection
