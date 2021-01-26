<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



use jeremykenedy\LaravelRoles\App\Http\Requests\StoreRoleRequest;
use jeremykenedy\LaravelRoles\Traits\RolesAndPermissionsHelpersTrait;
use jeremykenedy\LaravelRoles\Traits\RolesUsageAuthTrait;

class RolesController extends Controller
{
    use RolesAndPermissionsHelpersTrait;

    public function listRoleUsers(Request $request){

        $auth = Auth::user();
        $data = $this->getDashboardData();
        $per_page = $request->per_page;

        if ($auth->hasPermission('view.users')) { // you can pass an id or slug
            return response()->json(["status_code" => 200, "result" => $data['data']]);
        }else{
            return abort(403, "Unauthorized Access Denied");
        }

    }
}
