<?php

namespace App\Http\Controllers;
use App\Notification as Notification;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class ParentsnotifController extends Controller
{
    //
    public function index($admin_id,$parents_id)
  {
    return view('notification.parentsNotif' ,compact('admin_id','parents_id'));
  }
  public function store(Request $request)
   
    {
      $request->validate([
      
        'admin_id'=> 'required|numeric',
        'recipients' => 'required|array',
        'msg' => 'required|string',
      ]);
      //DB::transaction(function () {
      for($i=0; $i < count($request->recipients); $i++){
        $tb = new Notification;
        $tb->sent_status = 1;
        $tb->active = 1;
        $tb->message = $request->msg;
        $tb->student_id = $request->recipients[$i];
        $tb->user_id = $request->admin_id;
        $tb->created_at = date('Y-m-d H:i:s');
        $tb->updated_at = date('Y-m-d H:i:s');
        $n[] = $tb->attributesToArray();
      }
      Notification::insert($n);
      //});
      return back()->with('status',__('Message Sent'));
    }

    public function show($id)
    {
      $msg = Notification::where('student_id',$id)
      ->orderBy('id','desc')
      ->paginate(10);
      $msgs = [];
      foreach($msg as $m){
        $msgs[] = [
            'id' => $m->id,
            'active' => 0,
            'updated_at' => date('Y-m-d H:i:s'),
          ];
      }
      $notifTb = new Notification;
      \Batch::update($notifTb,(array) $msgs,'id');
      return view('message.all',['messages'=>$msg]);
    }
}
