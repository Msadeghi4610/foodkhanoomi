@extends('layout.app')
@section('content')
    @php
    $row=0;
    $tottal_price=0;
    $maliat=0;
    $paik=0;
    $user=\App\Models\User::findorfail($order_user->user_id);
    @endphp
    <div id="factor" class="container">
        <div style="width: 420px" class="mx-auto mb-3  px-1 py-2 border border-dark rounded">
            <div>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <span>شماره پیگیری:</span>
                        <span class="f-vazir">{{$order_user->id}}</span>
                    </div>
                    <div>
                        <span>تاریخ و ساعت ثبت:</span>
                        <span class="f-vazir">{{jdate($order_user->created_at)->format('H:m:i Y/m/d')}}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <span>نام مشتری:</span>
                        <span>{{$user->name}}</span>
                    </div>
                    <div>
                        <span>شماره تماس:</span>
                        <span class="f-vazir">{{$user->mobile}}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <span>آدرس:</span>
                        <span>{{$user->Address}}</span>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead class="table-secondary">
                <tr>
                    <td>ردیف</td>
                    <td>نام غذا</td>
                    <td>تعداد</td>
                    <td>قیمت</td>
                    <td>قیمت کل</td>
                </tr>
                </thead>
                <tbody>
                @php
                $items=\App\Models\Item::where('order_id',$order_user->id)->get();
                @endphp
                @foreach($items as $item)
                    <tr>
                    @php
                    $food=\App\Models\Food::where('id',$item->food_id)->first();
                    @endphp
                    <td class="f-vazir">{{++$row}}</td>
                    <td>{{$food->name}}</td>
                    <td class="f-vazir">{{$item->count}}</td>
                    <td class="f-vazir">{{$item->price}}</td>
                    <td class="f-vazir">{{$item->price * $item->count}}</td>
                    </tr>
                    @php
                    $tottal_price +=$item->price * $item->count;
                    @endphp
                @endforeach
                </tbody>
                <tfoot class="table-group-divider">
                <tr>
                    <td colspan="4" class="text-end">قیمت کل</td>
                    <td class="f-vazir">{{$tottal_price}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">مالیات</td>
                    <td class="f-vazir">{{$maliat=($tottal_price*10)/100}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">هزینه ارسال</td>
                    @php
                    if ($order_user->food_send==1){
                        $paik=50000;
                    }
                    @endphp
                    <td class="f-vazir">{{$paik}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">جمع کل</td>
                    <td class="f-vazir">{{$tottal_price+$maliat+$paik}}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
