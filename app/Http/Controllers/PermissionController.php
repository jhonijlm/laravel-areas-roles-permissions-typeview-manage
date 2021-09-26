<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function list(){
        return response()->json(
            Permission::select("id", "name", "slug")->get()
        , 200);
    }
}
