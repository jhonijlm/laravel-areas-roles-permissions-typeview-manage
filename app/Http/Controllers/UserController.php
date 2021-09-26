<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Rules\EmailRule;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View {
        $this->authorize("hasPermission", ["administrator", "users", "index"]);

        $isAccess = false;

        $users = User::select([
            "id",
            "name",
            "last_name",
            "cell_phone",
            "email",
            "address"
        ])->where("status", 1)->with("roles");

        if(Auth::user()->hasPermission("administrator", "users", "list", "partial")){
            $users->where("user_created_id", Auth::id())->orWhere("id", Auth::id());
            $isAccess = true;
        }else if(Auth::user()->hasPermission("administrator", "users", "list", "total")){
            $isAccess = true;
        }

        if($isAccess){
            return view("administrator.users.index")->with([
                "users" => $isAccess ? $users->paginate(10) : []
            ]);
        }else{
            abort(403);
        }
    }


    public function create(): View {
        $this->authorize("hasPermission", ["administrator", "users", "create"]);

        $roles = Role::where("status", 1)->select(["id", "name", "slug"]);

        $isAccess = false;
        if(Auth::user()->hasPermission("administrator", "roles", "list", "partial")){
            $roles->where("user_created_id", Auth::id());
            $isAccess = true;
        }else if(Auth::user()->hasPermission("administrator", "roles", "list", "total")){
            $isAccess = true;
        }

        if($isAccess){
            return view("administrator.users.create")->with([
                "roles" => $roles->get()
            ]);
        }else{
            abort(403);
        }


    }

    public function store(UserRequest $request) {
        $this->authorize("hasPermission", ["administrator", "users", "create"]);
        $this->validate($request, [
            "email" => ['required', 'string', 'email', 'max:120', new EmailRule],
            'password' => 'required|min:3|max:50'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->cell_phone = $request->cell_phone;
        $user->password = bcrypt($request->password);
        $user->user_created_id = Auth::check() ? Auth::id() : 0;
        $user->status = 1;
        $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('administrator.users.index');
    }

    public function edit($id): View {
        $user = User::where(["id" => $id, "status" => 1])->selecT([
            "id",
            "name",
            "last_name",
            "cell_phone",
            "email"
        ])->with("roles")->first();
        if($user){
            $this->authorize('get', [$user , ["administrator", "users", "get"]]);
        }else{
            abort(404);
        }

        $roles = Role::where("status", 1)->select(["id", "name", "slug"]);
        $isAccess = false;
        if(Auth::user()->hasPermission("administrator", "roles", "list", "partial")){
            $roles->where("user_created_id", Auth::id());
            $isAccess = true;
        }else if(Auth::user()->hasPermission("administrator", "roles", "list", "total")){
            $isAccess = true;
        }

        if($isAccess){
            return view("administrator.users.edit")->with([
                "user" => $user,
                "roles" => $roles->get()
            ]);
        }else{
            abort(403);
        }

    }

    public function update(UserRequest $request, $id){
        if($request->password != null){
            $this->validate($request, [
                "email" => ['required', 'string', 'email', 'max:120', new EmailRule('update')],
                'password' => 'required|min:3|max:50'
            ]);
        }

        $user = User::where(["id" => $id, "status" => 1])->first();

        if($user){
            $this->authorize('update', [$user , ["administrator", "users", "update"]]);
        }else{
            abort(404);
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->cell_phone = $request->cell_phone;
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }
        $user->user_updated_id = Auth::check() ? Auth::id() : 0;
        $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('administrator.users.index');
    }

    public function delete(Request $request, $id){

        $user = User::where(["id" => $id, "status" => 1])->first();
        if($user){
            $this->authorize('delete', [$user , [ "administrator", "users", "delete"]]);
        }else{
            abort(404);
        }

        $user->status = 2;
        $user->user_deleted_id = Auth::check() ? Auth::id() : 0;
        $user->deleted_at = Carbon::now();
        $user->save();

        return redirect()->route('administrator.users.index');
    }
}
