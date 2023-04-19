<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Spatie\Permission\Models\Permission;
class HomeController extends Controller
{
    public function read_notification()
    {
        try {
            $user = Auth::user();
            foreach ($user->unreadNotifications as $notification) {
                $notification->markAsRead();
            }
            return 'ok';
        } catch (\Exception $e) {
            return 'no';
        }
    }
}
