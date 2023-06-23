<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use App\Models\Order;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function acceptOrderNotification($id,$dateS,$dateE,$time,$loc)
    {
        $order=Order::where('order_Id', $id)->first();
        $notification=new Notification();
        
        $notification->type="customer";
        $notification->user_Id=$order->user_Id;
        $notification->title="Order Status Update";
        $notification->message="Your Order Has Been Accepted";
        $notification->status="unseen";
        $notification->photo="processing";
        $notification->save();

        return redirect('/acceptOrder'.'/'.$id.'/'.$dateS.'/'.$dateE.'/'.$time.'/'.$loc);
    }


    public function denyOrderNotification($id,$reason)
    {
        $order=Order::where('order_Id', $id)->first();
        $notification=new Notification();
        
        $notification->type="customer";
        $notification->user_Id=$order->user_Id;
        $notification->title="Order Status Update";
        $notification->message="Your Order Has Been Denied";
        $notification->status="unseen";
        $notification->photo="reject";
        $notification->save();

        return redirect('/denyOrder'.'/'.$id.'/'.$reason);
    }

    public function completeOrderNotification($id,$reason)
    {
        $order=Order::where('order_Id', $id)->first();
        $notification=new Notification();
        
        $notification->type="customer";
        $notification->user_Id=$order->user_Id;
        $notification->title="Order Status Update";
        $notification->message="Your Order Has Been Completed";
        $notification->status="unseen";
        $notification->photo="completed";
        $notification->save();
        
        return redirect('/completeOrder'.'/'.$id.'/'.$reason);
    }

    public function deleteNotification($id)
    {
        Notification::where([ 'id' => $id ])->delete();  
        return redirect()->back();
    }

    public function deleteNotificationAdmin($id,$userid)
    {
        $notifications=Notification::all();
        foreach($notifications as $notification)
        {   if($id==$notification->id)
            {
                $admins=str_replace($userid.',',"",$notification->admins);
                Notification::where([ 'id' => $notification->id,'type' => 'admin' ])->update(array('admins' => $admins));
                if(!str_contains($notification->admins,','))
                    Notification::where([ 'id' => $notification->id ])->delete();     
            }    
        }
        return redirect()->back();
    }

    public function deleteAllNotifications($id)
    {
        Notification::where([ 'user_Id' => $id,'type' => 'customer' ])->delete();      
        return redirect()->back();
    }

    public function deleteAllNotificationsAdmin($id)
    {
        $notifications=Notification::all();
        foreach($notifications as $notification)
        {
            $admins=str_replace($id.',',"",$notification->admins);
            Notification::where([ 'id' => $notification->id,'type' => 'admin' ])->update(array('admins' => $admins)); 
            if(!str_contains($notification->admins,','))
                Notification::where([ 'id' => $notification->id ])->delete();      
        }
        
        return redirect()->back();
    }
    

    
}
