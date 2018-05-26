<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Notification;

class NotificationController extends Controller{

    public function create($description){
        Notification::create([
            'description'   => $description
        ]);
    }

    public function showList(){
        return response()->json(Notification::select('description','created_at')->whereDate('created_at', date('Y/m/d'))->orderBy("created_at", 'desc')->get());
    }

    public function show(){
        $datas = Notification::select('id', 'description','created_at')->whereDate('created_at', date('Y/m/d'))->orderBy("created_at", 'desc')->get();
        
        return view('notification', compact('datas'));
    }

    public function delete($id){
        Notification::destroy($id);
        
        return redirect()->route('notification.show');
    }
}
