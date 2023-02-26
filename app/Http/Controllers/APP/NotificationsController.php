<?php

namespace App\Http\Controllers\APP;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StartupSavings;
use App\Models\Notifications;
use Illuminate\Http\Request;
use DB;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = Notifications::getAll();
        return view('admin/notifications', compact('notifications'));
    }

    public function read($id)
    {
        $readNotif = Notifications::find($id);
        $readNotif->update(['status'=> 1]);

        return redirect('/notifications');
    }

    public function unread($id)
    {
        $readNotif = Notifications::find($id);
        $readNotif->update(['status'=> 0]);

        return redirect('/notifications');
    }

    public function bulkread()
    {
        $notifications = Notifications::getAll();

        foreach($notifications as $item)
        {
            if($item->status === 0)
            {
                Notifications::read($item->id);
            }
        }

        return redirect('notifications');
    }

    public function bulkunread()
    {
        $notifications = Notifications::getAll();

        foreach($notifications as $item)
        {
            if($item->status === 1)
            {
                Notifications::unread($item->id);
            }
        }

        return redirect('notifications');
    }
}
