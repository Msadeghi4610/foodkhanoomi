@extends('layout.app')
@section('content')
    <div id="login"
         class="col-10 col-lg-6 mx-auto my-5 py-5 px-3 border border-2 border-secondary border-opacity-25 rounded-1 shadow-lg ">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                {{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
            @if(\Illuminate\Support\Facades\Session::has('login'))
                <div class="alert alert-primary">{{\Illuminate\Support\Facades\Session::get('login')}}</div>
            @endif
        <form action="{{url('checklogin')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="mobile_user" class="form-label">شماره تلفن همراه را وارد نمائید</label>
                <input type="tel" name="mobile_user" value="{{old('mobile')}}" class="form-control f-vazir text-start">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">رمز عبور را وارد نمائید</label>
                <input type="password" name="password" class="form-control text-start">
            </div>
            <div class="mb-3 d-flex flex-row justify-content-start">
                <button type="submit" class="btn btn-success fw-700 px-5 py-2 w-25 me-3">ورود</button>
            </div>
        </form>
    </div>
@endsection
