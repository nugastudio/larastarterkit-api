<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
class UsersController extends Controller
{
    //

    public function getUsers(Request $request){
        $user = Auth::user();
        // return dd($request->all());

        $per_page = $request->per_page;

        if ($user->hasPermission('view.users')) { // you can pass an id or slug
            return response()->json(["status_code" => 200, "result" => User::paginate($per_page)]);
        }else{
            return abort(403, "Unauthorized Access Denied");
        }

    }

}
