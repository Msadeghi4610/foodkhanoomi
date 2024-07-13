@extends('layout.app')
@section('content')
    <div id="login"
         class="col-10 col-lg-6 mx-auto my-5 py-5 px-3 border border-2 border-secondary border-opacity-25 rounded-1 shadow-lg text-start ">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                {{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
            @if(\Illuminate\Support\Facades\Session::has('successupdate'))
                <div class="alert alert-success f-vazir">{{\Illuminate\Support\Facades\Session::get('successupdate')}}</div>
            @endif
        <form action="/user/update/{{\Illuminate\Support\Facades\Auth::user()->id}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="phone">شماره تلفن همراه</label>
                <input type="text" class="form-control f-vazir {{($errors->has('mobile_user')) ? 'border-danger': ''}}"
                       name="mobile_user" value="{{\Illuminate\Support\Facades\Auth::user()->mobile}}" disabled>
            </div>
            <div class="mb-3">
                <label for="name_user">لطفا نام و نام خانوادگی را وارد نمائید</label>
                <input type="text" class="form-control f-vazir {{($errors->has('name_user')) ? 'border-danger': ''}}"
                       name="name_user" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
            </div>
            <div class="mb-3">
                <label for="phone">لطفا آدرس را وارد نمائید</label>
                <textarea rows="5" class="form-control fw-700 {{($errors->has('Address_user')) ? 'border-danger': ''}}"
                          name="Address_user">{{\Illuminate\Support\Facades\Auth::user()->Address}}</textarea>
            </div>
            <div class="mb-3 d-flex flex-row justify-content-between">
                <button type="submit" class="btn btn-success fw-700 px-5 py-2 w-50">ویرایش</button>
            </div>
        </form>
    </div>
@endsection
