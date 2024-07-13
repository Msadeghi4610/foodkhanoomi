@extends('layout.app');
@section('content')
<div id="list_food" class="container">
    <a class="btn btn-primary fw-700 px-5 py-2 my-3" href="{{url('Admin/food/add')}}">افزودن غذا</a>
    <div class="accordion" id="accordionExample">
        @foreach(\App\Models\Category::all() as $category)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-700 fs-4 bg-secondary bg-opacity-25 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#food{{$category->id}}">
                        {{$category->name}}
                    </button>
                </h2>
                <div id="food{{$category->id}}" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    @foreach(\App\Models\Food::where('category_id',$category->id)->get() as $food)
                        <div class="accordion-body">
                            <table class="table table-sm f-vazir align-middle text-start" style="min-width: 50px">
                                <tbody>
                                <tr class="border-bottom border-dark">
                                    <td class="col-1">
                                        <img src="/image/{{$food->photo}}" class="rounded-pill">
                                    </td>
                                    <td class="col-1">{{$food->name}}</td>
                                    <td class="col-4">{{$food->details}}</td>
                                    <td class="col-1">{{$food->price}} تومان</td>
                                    <td class="col-2 text-center">
                                       <a href="/Admin/food/edit/{{$food->id}}" class="btn btn-success fw-700 mb-1 px-2 py-2" style="width: 150px">ویرایش</a>
                                        <form action="/Admin/food/delete/{{$food->id}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger fw-700 py-2" style="width: 150px">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>

        @endforeach
    </div>
</div>
@endsection
