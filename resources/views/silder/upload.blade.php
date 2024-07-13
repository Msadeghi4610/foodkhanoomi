@extends('layout.app')
@section('content')
    <div id="slider" class="container">

        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                {{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success f-vazir">{{\Illuminate\Support\Facades\Session::get('success')}}</div>
            @endif
            @if(\Illuminate\Support\Facades\Session::has('delete'))
                <div class="alert alert-success f-vazir">{{\Illuminate\Support\Facades\Session::get('delete')}}</div>
            @endif
        <div class="text-center" >
            <form action="{{url('Admin/slider/store')}}" method="post" enctype="multipart/form-data" class="d-flex justify-content-center">
              @csrf
                <input type="file"  name="photo" class="form-control fw-700 w-75">
                <button type="submit" class="btn btn-primary f-vazir ms-3 px-5">آپلود</button>
            </form>
        </div>
        @php
        $slider=\App\Models\Slider::all();
        @endphp
        <div class="d-flex flex-wrap mt-3">
            @php
            $slider_img=\App\Models\Slider::orderby('id','desc')->get();
            @endphp
            @foreach($slider_img as $s_img)
                <div class="card" style="width: 15rem;">
                    <img src="/image/{{$s_img->name}}" class="card-img-top h-100" alt="...">
                    <div class="card-body">
                        <form action="/Admin/slider/delete/{{$s_img->id}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger fw-700 py-2" style="width: 150px">حذف</button>
                        </form>
                    </div>
                </div>
            @endforeach
 </div>
    </div>
@endsection
