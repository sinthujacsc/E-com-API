<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $data = DB::table('activity_log')
        ->select('activity_log.*','users.name')
        ->join('users', 'users.id', '=', 'activity_log.subject_id')
        ->orderBy('created_at','desc')   
        ->get(); 
    
           return response()->json(['status'=> true,
                                    'data'=>$data]);
        // return auth()->user();
    }

    public function destroy($id)
    {
        $data = ActivityLog::findOrFail($id);
        $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);         //
    }

    public function show($id)
    {
        $data = ActivityLog::findOrFail($id);
        return response()->json($data, 200);
        //
    }
    public function filterActivity($searchText){
        return response()->json(ActivityLog::where('description','like',"%{$searchText}%")
        ->get(),200);
    }

    //
}
