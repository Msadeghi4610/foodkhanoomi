<nav class="navbar navbar-expand-lg shadow-md">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="navbar-brand text-center d-flex flex-column align-items-center ms-2 col-9 col-lg-1">
            <span class="text-success font_bold">رستوران خانومی</span>
            <span class="fs_05 text-danger">انواع غذای ایرانی و فست فود</span>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-5 text-center" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">خانه</a>
                    </li>
                    @if(\Illuminate\Support\Facades\Auth::user()->Access_user==2)
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/Admin')}}">داشبورد</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('Admin/slider')}}">اسلایدر</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('Admin/category')}}">دسته بندی</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('Admin/food/list')}}">غذا</a>
                        </li>
                    @endif
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="{{url('order/')}}">سفارشات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('user/edit')}}">ویرایش اطلاعات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('logout')}}">خروج</a>
                    </li>
                @endif
            </ul>
            <div id="phone_header" class="d-none d-lg-flex flex-row justify-content-center align-items-center me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                     class="bi bi-phone-vibrate" viewBox="0 0 16 16">
                    <path
                        d="M10 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM6 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"/>
                    <path
                        d="M8 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2M1.599 4.058a.5.5 0 0 1 .208.676A7 7 0 0 0 1 8c0 1.18.292 2.292.807 3.266a.5.5 0 0 1-.884.468A8 8 0 0 1 0 8c0-1.347.334-2.619.923-3.734a.5.5 0 0 1 .676-.208m12.802 0a.5.5 0 0 1 .676.208A8 8 0 0 1 16 8a8 8 0 0 1-.923 3.734.5.5 0 0 1-.884-.468A7 7 0 0 0 15 8c0-1.18-.292-2.292-.807-3.266a.5.5 0 0 1 .208-.676M3.057 5.534a.5.5 0 0 1 .284.648A5 5 0 0 0 3 8c0 .642.12 1.255.34 1.818a.5.5 0 1 1-.93.364A6 6 0 0 1 2 8c0-.769.145-1.505.41-2.182a.5.5 0 0 1 .647-.284m9.886 0a.5.5 0 0 1 .648.284C13.855 6.495 14 7.231 14 8s-.145 1.505-.41 2.182a.5.5 0 0 1-.93-.364C12.88 9.255 13 8.642 13 8s-.12-1.255-.34-1.818a.5.5 0 0 1 .283-.648"/>
                </svg>
                <i class="bi bi-phone-vibrate"></i>
                <span class="pt-1 ms-2 f-vazir">1833</span>
            </div>
            @if(\Illuminate\Support\Facades\Auth::check())
                <div id="phone_header" class="d-none d-lg-flex flex-row justify-content-center align-items-center me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                         class="bi bi-person-circle text-secondary text-opacity-50" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd"
                              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                    <span class="ms-2 text-dark">{{Auth::user()->name}}</span>
                </div>
            @else
                <button type="button"
                        class="fw-700 btn btn-light {{($errors->has('mobile')) ? 'bg-danger text-light': ''}} border border-opacity-50  py-2 px-4 ms-3 rounded rounded-3"
                        data-bs-target="#Modellogin" data-bs-toggle="modal">ورود | عضویت
                </button>
            @endif

            @if(\Illuminate\Support\Facades\Auth::check())
                <a data-bs-toggle="offcanvas" href="#BascketBuy" aria-controls="offcanvasWithBothOptions"
                   class="text-secondary position-relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="currentColor" class="bi bi-cart"
                         viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                    @php
                        if (\Illuminate\Support\Facades\Auth::check()){
                         $count_food=\App\Models\Order::orderBy('id','desc')
                            ->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)
                            ->where('status',0)->first();
                            if (!empty($count_food)){
                                $count_item=\App\Models\Item::where('order_id',$count_food->id)->get();
                    @endphp
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger f-vazir">{{$count_item->count()}}<span class="visually-hidden">unread messages</span>
  </span>
                    @php
                        }
                            }
                    @endphp
                </a>
            @endif

        </div>
    </div>
</nav>


<div class="offcanvas offcanvas-start" tabindex="-1" id="BascketBuy" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-start" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @php
        if (\Illuminate\Support\Facades\Auth::check()){
             $count_food=\App\Models\Order::orderBy('id','desc')
            ->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)
            ->where('status',0)->first();
            if (empty($count_food)){
        @endphp
        <div class="alert alert-primary">هیچی سفارشی ثبت نشده است</div>
        @php
            }else{
             $items_bascket=\App\Models\Item::where('order_id',$count_food->id)->get();
        @endphp
        <table class="table f-vazir">
            <thead class="table-secondary text-center">
            <tr>
                <td>نام غذا</td>
                <td>تعداد</td>
                <td>قیمت</td>
                <td>قیمت کل</td>
            </tr>
            </thead>
            @php
                foreach ($items_bascket as $item_bascket){
                    $food_bascket=\App\Models\Food::where('id',$item_bascket->food_id)->first();
            @endphp
            <tr>
                <td>{{$food_bascket->name}}</td>
                <td>{{$item_bascket->count}}</td>
                <td>{{$food_bascket->price}}</td>
                <td>{{$food_bascket->price * $item_bascket->count}}</td>
            </tr>
            @php
                }
            @endphp
            <tfoot class="table-group-divider">
            <tr>
                <td colspan="3" class="text-end">جمع کل</td>
                <td colspan="1">55000</td>
            </tr>
            </tfoot>
        </table>
        <a class="btn btn-primary w-100 f-vazir" href="{{url('order/')}}">ثبت نهایی سفارشات</a>
        @php
            }

        }else{
            @endphp
        <div class="alert alert-primary">جهت مشاهده سبد خرید و ثبت سفارش ابتدا وارد شوید</div>
        @php
        }
        @endphp
    </div>
</div>
















<div class="modal" id="Modellogin" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-11 text-center d-flex flex-column justify-content-center align-items-center">
                    <span class="text-success font_bold">رستوران خانومی</span>
                    <span class="fs_05 text-danger">انواع غذای ایرانی و فست فود</span>
                </div>
                <button type="button" class="btn-close col-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{'checkphone'}}" method="get">
                @csrf
                <div class="modal-body">
                    <label for="mobile" class="form-label fw-700">شماره تلفن همراه را وارد کنید</label>
                    <input type="text" name="mobile" class="form-control f-vazir">
                    @if($errors->has('mobile'))
                        <div class="form-text text-danger">{{$errors->first('mobile')}}</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100 fw-700">ثبت نام | ورود</button>
                </div>
            </form>
        </div>
    </div>
</div>
