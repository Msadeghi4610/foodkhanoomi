@extends('layout.app')
@section('content')

    <div class="container">
        @if($datas->isEmpty())
    <div class="alert alert-danger">دسته بندی برای نمایش وجود ندارد</div>
        @else
            <table class="table table-hover table-borderless">
                <thead class="border-dark border-bottom">
                <tr>
                    <td class="text-center">نام دسته بندی</td>
                    <td class="text-center">ویرایش</td>
                    <td class="text-center">حدف</td>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td class="text-center">{{$data->name}}</td>
                        <td class="text-center">
                            <form action="/Admin/category/edit/{{$data->id}}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-success fw-700">ویرایش</button>
                            </form>
                        </td>
                        <td class="text-center">
                            <form action="/Admin/category/delete/{{$data->id}}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger fw-700">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
            <button class="btn btn-primary fw-700 px-4" data-bs-target="#newcategory" data-bs-toggle="modal">افزودن دسته
                بندی
            </button>

            <!-- Modal -->
            <div class="modal fade" id="newcategory" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-11 text-center d-flex flex-column justify-content-center align-items-center">
                                <span class="text-success font_bold">رستوران خانومی</span>
                                <span class="fs_05 text-danger">انواع غذای ایرانی و فست فود</span>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('Admin/category/store')}}" method="post">
                                @csrf
                                <label for="name" class="form-label fw-700">نام دسته بندی را وارد کنید</label>
                                <input type="text" name="name" class="form-control f-vazir">
                                @if($errors->has('name'))
                                    <div class="form-text text-danger">
                                        {{$errors->first('name')}}
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-success fw-700 mt-3">ثبت دسته بندی</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
