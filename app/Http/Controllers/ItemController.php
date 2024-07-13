<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function delete($item_id)
    {
        $item=Item::findorfail($item_id);
        if (is_null($item_id)){
            abort('404');
        }else{
            $item_count=Item::where('order_id',$item->order_id)->get();
            if ($item_count->count()<2){
                $order=Order::findorfail($item->order_id);
                $order->delete();
                $item->delete();
                return redirect()->back();
            }else{
                $item->delete();
                return redirect()->back()->with('delete','غذای موردنظر حذف شد');
            }
        }
    }

    public function update(Request $request,$item_id)
    {
        $item=Item::findorfail($item_id);
        if (is_null($item)){
            abort('404');
        }else{
            if ($request->$item_id>0){
                $item->update([
                   'count'=> $request->$item_id,
                ]);
                return redirect()->back()->with('success','تعداد غذای موردنظر ویرایش شد');
            }
        }
    }
}
