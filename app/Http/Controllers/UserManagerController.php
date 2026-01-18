<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Admin;
use App\UserRoleEnum;
use App\Events\MyEvent;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserManagerController extends Controller
{
    public function listUsers(){
        $guard = getGuard();
        $loggedInUserId = auth($guard)->id();

        $admins = Admin::select('uuid', 'name', 'email', DB::raw("'Admin' as role"), 'is_online', 'last_seen_at')
        ->where('uuid', '!=', $loggedInUserId);

        $customers = Customer::select('uuid', 'name', 'email', DB::raw("'Customer' as role"), 'is_online', 'last_seen_at')
        ->where('uuid', '!=', $loggedInUserId);

        $users = $admins->unionAll($customers)->paginate(10);
        return view('authentication-templates.admin.dashboard.users')->with('users',$users);
    }

    public function syncUserStatus(Request $request){
        try{
            $user = auth($request->input('role'))->user();
            if($request->has('is_online')){
                $user->is_online = $request->input('is_online');
            }
            if(!$request->input('is_online')){
                $user->last_seen_at = now();
            }
            $user->save();
            return response()->json(['success' => 'Status updated successfully']);
        }catch(Exception $e){
            Log::error('Error updating the syncing status: '. $e->getMessage());
            return response()->json(['error' => 'Error in updating the status']);
        }
    }
}
