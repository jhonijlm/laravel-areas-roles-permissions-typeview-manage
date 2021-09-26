<?php

namespace App\Http\Controllers;

use App\Models\TypeView;
use Illuminate\Http\Request;

class TypeViewController extends Controller
{
    //
    public function list(){
        return response()->json(
            TypeView::select(["id", "name", "slug"])->get()
        , 200);
    }
}
