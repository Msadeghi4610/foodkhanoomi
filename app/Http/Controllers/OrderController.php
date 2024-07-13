<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Item;
use App\Models\Order;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use Symfony\Component\Console\Input\Input;

class OrderController extends Controller
{
    public function add(Request $request, $food_id)
    {
        $order_user = Order::orderBy('id', 'desc')
            ->where('user_id', Auth::user()->id)
            ->where('status', 0)->first();
        $food = Food::where('id', $food_id)->first();
        if (is_null($order_user)) {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'status' => 0,
            ]);
            Item::create([
                'order_id' => $order->id,
                'food_id' => $food_id,
                'count' => $request->$food_id,
                'price' => $food->price,
            ]);
            return redirect('/');
        } else {
            $find_item = Item::where('order_id', $order_user->id)
                ->where('food_id', $food_id)->first();
            if (!is_null($find_item)) {
                $item = Item::findorfail($find_item->id);
                $item->update([
                    'count' => $request->$food_id + $item->count,
                ]);
                return redirect('/');
            } else {
                Item::create([
                    'order_id' => $order_user->id,
                    'food_id' => $food_id,
                    'count' => $request->$food_id,
                    'price' => $food->price,
                ]);
                return redirect('/');
            }
        }
    }

    public function list()
    {
        $order_user = Order::orderBy('id', 'desc')
            ->where('user_id', Auth::user()->id)
            ->where('status', 0)->first();
        return view('order.list',[
            'order_user'=>$order_user,
        ]);
    }

    public function confirmed(Request $request,$order_id)
    {
        $order_id=Order::findorfail($order_id);
        $order_id->update([
            'food_send'=>$request->food_send,
            'status'=>1,
        ]);
        return view('order.factor',[
            'order_user'=>$order_id,
        ]);
    }

    public function history($user_id)
    {
        $order_user=Order::orderby('id','desc')->
            where('user_id',$user_id)->
            where('status',1)->get();
        return view('order.history',[
            'order_user'=>$order_user,
        ]);
    }

    public function delivery(Request $request)
    {
        $request->validate([
            'code'=>['required','regex:/^[0-9]+$/'],
        ]);
        $find_order=Order::where('id',$request->code)->first();
        if (is_null($find_order)){
            return redirect('/Admin')->with('find','کدپیگیری وارد شده  نامعتبر است');
        }else{
            return  view('Dashbord',[
                'order_user'=>$find_order,
            ]);
        }
    }

    public function update_status($order_id)
    {
        $order=Order::findorfail($order_id);
        $order->update([
            'status'=>2,
        ]);
        return redirect('/Admin')->with('updatestatus','فاکتور'.$order_id.'نحویل مشتری شد');
    }

    public function tarikh(Request $request)
    {
        $request->validate([
            'date_start'=>['required','date'],
            'date_end'=>['required','date'],
        ]);

        return redirect('/Admin')->withInput()->with('success_date','1');
    }
}
