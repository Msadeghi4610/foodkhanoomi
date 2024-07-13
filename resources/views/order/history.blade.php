@extends('layout.app')
@section('content')
    <div id="history" class="container">
    @php
        $row=0;
        $tottal_price=0;
        $maliat=0;
        $paik=0;
        if ($order_user->isEmpty()){
            @endphp
        <div class="alert alert-primary">تاکنون سفارشی توسط شما ثبت نشده است</div>
        @php
        }else{
            @endphp
        <table class="table mx-auto text-center f-vazir">
            <thead>
            <tr>
                <td>ردیف</td>
                <td>تاریخ</td>
                <td>کدپیگیری</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @foreach($order_user as $order)
                <tr>
                    <td>{{++$row}}</td>
                    <td>{{jdate($order->created_at)->format('Y/m/d   H:i:s')}}</td>
                    <td>{{$order->id}}</td>
                    <td><a data-bs-toggle="modal" data-bs-target="#{{$order->id}}" href="#">مشاهده جزئیات</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @foreach($order_user as $order)
            <div class="modal modal-dialog" id="{{$order->id}}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body table-responsive">
                            @php
                                $items=\App\Models\Item::where('order_id',$order->id)->get();
                            @endphp
                            <table class="table table-sm text-center">
                                <thead class="table-secondary">
                                <tr>
                                    <td>نام غدا</td>
                                    <td>تعداد</td>
                                    <td>قیمت</td>
                                    <td>قیمت کل</td>
                                </tr>
                                </thead>
                                @foreach($items as $item)

                                    @php
                                        $food=\App\Models\Food::where('id',$item->food_id)->first();
                                    @endphp
                                    <tbody>
                                    <tr>
                                        <td>{{$food->name}}</td>
                                        <td class="f-vazir">{{$item->count}}</td>
                                        <td class="f-vazir">{{$item->price}}</td>
                                        <td class="f-vazir">{{$item->count * $item->price}}</td>
                                    </tr>
                                    </tbody>
                                @endforeach
                                @php
                                    $tottal_price +=$item->count * $item->price;
                                @endphp
                                <tfoot class="table-group-divider">
                                <tr>
                                    <td colspan="3" class="text-end">قیمت کل</td>
                                    <td class="f-vazir">{{$tottal_price}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">مالیات</td>
                                    <td class="f-vazir">{{$maliat=($tottal_price*10)/100}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">هزینه ارسال</td>
                                    @php
                                        if ($order->food_send==1){
                                            $paik=50000;
                                        }
                                    @endphp
                                    <td class="f-vazir">{{$paik}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">جمع کل</td>
                                    <td class="f-vazir">{{$tottal_price+$maliat+$paik}}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach

        @php
        }
    @endphp
    </div>
@endsection
