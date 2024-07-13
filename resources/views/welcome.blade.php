@extends('layout.app')
@section('content')
    {{--slider--}}
    @php
        $silder_one=\App\Models\Slider::orderby('id','desc')->first();
        $silders=\App\Models\Slider::orderby('id','desc')->get();
    @endphp
    <div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active c_item">
                <img src="/image/{{$silder_one->name}}" class="c_pic d-block w-100 h-100">
            </div>
            @foreach($silders as $slider)
                @if($slider->id != $silder_one->id)
                    <div class="carousel-item c_item">
                        <img src="/image/{{$slider->name}}" class="c_pic d-block w-100 h-100">
                    </div>
                @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

{{--غذا--}}
    <div id="Food" class="container mt-3">
        @foreach(\App\Models\Category::all() as $category)
            <h1 class="fw-700 fs-2 text-dark bg-primary bg-opacity-50  rounded px-3 py-2 shadow-lg ">{{$category->name}}</h1>
            <section id="kabab" class="ps-3 d-flex flex-row flex-wrap  justify-content-sm-center
            justify-content-md-between">
            @foreach(\App\Models\Food::where('category_id',$category->id)->get() as $food)
                    <div  class="card col-12 col-lg-6  mb-3 me-1" style="max-width: 540px">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/image/{{$food->photo}}" class="img-fluid rounded-start h-100" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title font_bold">{{$food->name}}</h5>
                                    <p class="card-text">{{$food->details}}</p>
                                    <div id="price" class="d-flex flex-row justify-content-between align-self-centeri text-secondary text-opacity-75 fs-5">
                                        <p class="card-text fw-700 "><small class="text-danger font_bold fs-5 f-vazir">{{$food->price}}  تومان</small></p>
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <button type="submit" class="btn btn-success px-4 h-25 fw-700" data-bs-toggle="modal" data-bs-target="#food{{$food->id}}">ثبت</button>
                                        @else
                                            <button type="button"
                                                    class="fw-700 btn btn-light {{($errors->has('mobile')) ? 'bg-danger text-light': ''}} border border-opacity-50  py-2 px-4 ms-3 rounded rounded-3"
                                                    data-bs-target="#Modellogin" data-bs-toggle="modal">ورود | عضویت
                                            </button>
                                        @endif
                                    </div>

                                    <div class="modal fade" id="food{{$food->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <img src="/image/{{$food->photo}}" class="img-fluid rounded-start w-100">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-around">
                                                        <h3 class="fw-700 mt-3">{{$food->name}}</h3>
                                                        <p class="mb-3 text-secondary fs-5">{{$food->details}}</p>
                                                        <form action="/order/add/{{$food->id}}" method="post">
                                                            @csrf
                                                            <div class="d-flex justify-content-between mt-5">
                                                                <span class="f-vazir text-danger fs-4">{{$food->price}}تومان</span>
                                                                <form action="#" method="post">
                                                                    <input type="number"
                                                                           name="{{$food->id}}" class="form-control f-vazir w-25" value="1" min="1" max="20">
                                                            </div>
                                                            <div class="w-100 text-center mt-5">
                                                                <button type="submit" class="btn btn-primary mx-auto w-100 fw-700 py-3">ثبت سفارش</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            </section>
        @endforeach
    </div>
@endsection
