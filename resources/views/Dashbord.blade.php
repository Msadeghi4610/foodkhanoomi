@extends('layout.app')
@section('content')
    <div id="Delivery_food" class="container shadow my-3 pb-5">
        <div class="container-fluid bg-primary bg-opacity-25 py-3 mb-3 rounded">
            پیگیری سفارش
        </div>
        @if(\Illuminate\Support\Facades\Session::has('updatestatus'))
            <div class="alert alert-success f-vazir">{{\Illuminate\Support\Facades\Session::get('updatestatus')}}</div>
        @endif
        @if($errors->has('code'))
            <div class="alert alert-danger alert-dismissible">
                {{$errors->first('code')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('find'))
            <div class="alert alert-danger">{{\Illuminate\Support\Facades\Session::get('find')}}</div>
        @endif
        <div class="mx-auto">
            <form action="{{url('order/Delivery_food')}}" method="post" class="d-flex justify-content-center">
                @csrf
                <input type="text" name="code" class="form-control w-50 f-vazir" placeholder="کد پیگیری را وارد نمائید">
                <button type="submit" name="send" class="btn btn-primary fw-700 ms-2">جستجو</button>
            </form>
        </div>
        @if(isset($_REQUEST['send']))
            <table class="table mt-3">
                <thead class="table-secondary">
                <tr>
                    <td>شماره پگیری</td>
                    <td>نام مشتری</td>
                    <td>تایخ و ساعت</td>
                    <td>مشاهده جزئیات</td>
                    <td>وضعیت سفارش</td>
                </tr>
                </thead>
                <tbody>
                @php
                    $user=\App\Models\User::where('id',$order_user->user_id)->first();
                @endphp
                <tr class="f-vazir">
                    <td>{{$order_user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{jdate($order_user->created_at)->format('Y/m/d H:i:s')}}</td>
                    <td><a href="#" class="text-decoration-none" data-bs-toggle="modal"
                           data-bs-target="#{{$order_user->id}}">مشاهده جزئیات</a></td>
                    <td>
                        @if($order_user->status==0)
                            در حال تکمیل سفارش
                        @elseif($order_user->status==1)
                            در انتظار تحویل سفارش
                        @elseif($order_user->status==2)
                            سفارش تحویل داده شده
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>

            @php
                $tottal_price=0;
                $maliat=0;
                $paik=0;
            @endphp
            <div class="modal modal-dialog" id="{{$order_user->id}}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body table-responsive">
                            @php
                                $items=\App\Models\Item::where('order_id',$order_user->id)->get();
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
                                        if ($order_user->food_send==1){
                                            $paik=50000;
                                        }
                                    @endphp
                                    <td class="f-vazir">{{$paik}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">جمع کل</td>
                                    <td class="f-vazir">{{$tottal_price+$maliat+$paik}}</td>
                                </tr>
                                @if($order_user->status==1)
                                    <tr>
                                        <td colspan="4">
                                            <form action="/order/updatestatus/{{$order_user->id}}" method="post">
                                                @csrf
                                                <button class="btn btn-success w-100 f-vazir">تحویل سفارش</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        @endif

    </div>

    <div id="shop" class="container shadow-lg pb-5 my-3">

        @php
            $row=0;
            $tottal_item=0;
            $paik=0;
        @endphp

        <div class="bg-primary bg-opacity-25 py-3 px-2 mb-3 rounded">گزارش فروش</div>
        @if($errors->has('date_start'))
            <div class="alert alert-danger alert-dismissible">
                {{$errors->first('date_start')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if($errors->has('date_end'))
            <div class="alert alert-danger alert-dismissible">
                {{$errors->first('date_end')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('novalid_date'))
            <div class="alert alert-danger">{{\Illuminate\Support\Facades\Session::get('novalid_date')}}</div>
        @endif
        <div>

            <form action="{{url('order/test')}}" method="post"
                  class="d-flex flex-column flex-md-row justify-content-center align-items-center">
                @csrf
                <div class="me-3">
                    <input type="text" name="date_start" class="form-control f-vazir w-100"
                           placeholder="بازه شروع جستجو را وارد کنید">
                    <div class="form-text">لطفا تاریخ را مانند نمونه وارد کنید <span class="f-vazir">1403/03/25</span>
                    </div>
                </div>
                <div>
                    <input type="text" name="date_end" class="form-control  f-vazir w-100"
                           placeholder="بازه پایانی جستجو را وارد کنید">
                    <div class="form-text">لطفا تاریخ را مانند نمونه وارد کنید <span class="f-vazir">1403/03/25</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary fw-700 ms-2">جستجو</button>
            </form>
        </div>
        @if(\Illuminate\Support\Facades\Session::has('success_date'))
            @php
                $date_start=implode('',explode('/',old('date_start')));
                $date_end=implode('',explode('/',old('date_end')));
                $date_now=\Hekmatinasser\Verta\Verta::now()->format('Ymd');
                if ($date_end>$date_now || $date_start>$date_now){
            @endphp
            <div class="alert alert-danger">تاریخ پایان یا شروع گزارش نمی نواند مربوط به روز های آینده باشد</div>
            @php
                }elseif ($date_end<$date_start){
            @endphp
            <div class="alert alert-danger">تاریخ پایان نباید کوچکتر از تاریخ شروع گزارش باشد</div>
            @php
                }else{
                    $orders=\App\Models\Order::all();
                    foreach ($orders as $order){
                        $date1=explode(' ',$order->updated_at);
                        $date2=explode('-',$date1[0]);
                        $date3=\Hekmatinasser\Verta\Verta::instance(implode('',$date2))->format('Ymd');
                        if ($date3>=$date_start && $date3<=$date_end){
                            $row++;
                            if ($order->food_send==1){
                                $paik++;
                            }
                            $items=\App\Models\Item::where('order_id',$order->id)->get();
                            foreach ($items as $item){
                                $tottal_item +=$item->count*$item->price;
                            }
                        }
                    }
                    if ($row==0){
            @endphp
            <div class="alert alert-primary">در این تاریخ هیچ گزارشی یافت نشد</div>
            @php
                }else{
            @endphp
        <table class="table text-center mt-4">
            <thead class="table-secondary">
            <tr>
                <th>تعداد کل سفارش</th>
                <th>تحویل در محل</th>
                <th> تحویل با پیک</th>
                <th>جمع کل(تومان)</th>
            </tr>
            </thead>
            <tr class="f-vazir">
                <td>{{$row}}</td>
                <td>{{$row-$paik}}</td>
                <td>{{$paik}}</td>
                <td>{{$tottal_item+($paik*50000)+(($tottal_item*10)/100)}}</td>
            </tr>
        </table>
            @php
                }
                    }
            @endphp
        @endif
    </div>

    <div id="UserManager" class="container shadow-lg pb-5">
        <div class="bg-primary bg-opacity-25 py-3 px-2 mb-3 rounded">مدیریت کاربران</div>
        @if(\Illuminate\Support\Facades\Session::has('deleteuser'))
            <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('deleteuser')}}</div>
        @endif
        @if($errors->has('finduser'))
            <div class="alert alert-danger"> {{$errors->first('finduser')}}</div>
        @endif
        <div class="mx-auto">
            <form action="{{url('user/Admin/find')}}" method="post" class="d-flex justify-content-center">
                @csrf
                <input type="text" name="finduser" class="form-control w-50 f-vazir" placeholder="نام کاربر را وارد نمائید">
                <button type="submit" name="sendfind" class="btn btn-primary fw-700 ms-2">جستجو</button>
            </form>
        </div>
        @if(\Illuminate\Support\Facades\Session::has('sucess_find'))
            @php
            $find=old('finduser');
                 $users=\App\Models\User::where('name','LIKE', '%'.$find.'%')->get();
            if ($users->isEmpty()){
                @endphp
        <div class="alert alert-primary mt-3">کاربری با این نام یافت نشد</div>
        @php
            }else{
        @endphp
        <table class="table mt-3">
            <thead class="table-secondary">
            <tr>
                <td>نام کاربر</td>
                <td>تلفن همراه</td>
                <td>آدرس</td>
                <td>حذف</td>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="f-vazir">
                    <td>{{$user->name}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->Address}}</td>
                    <td>
                        <form action="/user/Admin/delete/{{$user->id}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @php
            }
            @endphp
        @endif
    </div>
@endsection
