@extends('layout.app')
@section('content')
    @php
        $row=0;
        $tottal_price=0;
    $maliat=0;
    @endphp
    <div class="container">
        <a href="order/history/{{\Illuminate\Support\Facades\Auth::user()->id}}" class="btn btn-primary fw-700 mb-3 px-4">سفارشات گذشته</a>
        @if (is_null($order_user))
            <div class="alert alert-primary">
                هیچ سفارشی موجود نمیباشد.
            </div>
        @else
            @if(\Illuminate\Support\Facades\Session::has('delete'))
                <div class="alert alert-danger">{{\Illuminate\Support\Facades\Session::get('delete')}}</div>
            @endif
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('success')}}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-secondary">
                    <tr>
                        <td>ردیف</td>
                        <td class="text-start">نام غذا</td>
                        <td>تعداد</td>
                        <td>قیمت(تومان)</td>
                        <td>قیمت کل(تومان)</td>
                        <td>ویرایش/حذف</td>
                    </tr>
                    </thead>
                    <tbody class="f-vazir">
                    @php
                        $items=\App\Models\Item::where('order_id',$order_user->id)->get();
                    @endphp
                    @foreach($items as $item)
                        @php
                            $food=\App\Models\Food::where('id',$item->food_id)->first();
                        @endphp
                        <tr>
                            <td>{{++$row}}</td>
                            <td class="text-start">{{$food->name}}</td>
                            <td>{{$item->count}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->price * $item->count}}</td>
                            <td class="d-flex justify-content-center">
                                <form action="/item/update/{{$item->id}}" method="post" class="d-flex">
                                    @csrf
                                    <input type="number" style="width: 70px;" value="{{$item->count}}" min="1" max="20"
                                           class="form-control" name="{{$item->id}}">
                                    <button type="submit" class="btn btn-success fw-700 mx-2">ثبت</button>
                                </form>
                                <form action="/item/delete/{{$item->id}}" method="post" class="d-flex">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger fw-700">حذف</button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $tottal_price +=$item->price * $item->count;
                        @endphp
                    @endforeach
                    </tbody>
                    <tfoot class="table-group-divider f-vazir">
                    <tr>
                        <td colspan="4" class="text-end">قیمت کل</td>
                        <td colspan="2" class="text-start ps-5">{{$tottal_price}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end">مالیات</td>
                        <td colspan="2" class="text-start ps-5">{{$maliat=($tottal_price*10)/100}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end">جمع کل</td>
                        <td colspan="2" class="text-start ps-5">{{$tottal_price+$maliat}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <form action="/order/confirmedorder/{{$order_user->id}}" method="post">
                @csrf
                <div class="form-check-inline">
                    <input class="form-check-input" name="food_send" type="radio" value="0" id="mahal" checked>
                    <label class="form-check-label" for="mahal">
                        تحویل در محل
                    </label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" name="food_send" type="radio" value="1" id="paik">
                    <label class="form-check-label" for="paik">
                        از طریق پیک
                    </label>
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-primary fw-700 px-4">تکمیل سفارش خرید</button>
                </div>
            </form>
        @endif
    </div>
@endsection
