<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Role;
use Illuminate\View\View;
use App\Models\AccessDetail;
use Illuminate\Http\Request;
use App\Services\AreaService;
use Illuminate\Support\Carbon;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ModuleAreaPermission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    public $areaService;
    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
        $this->middleware('auth');
    }

    public function index(): View {
        $this->authorize("hasPermission", ["administrator", "roles", "index"]);

        $roles = Role::filtered();

        $isAccess = false;
        if(Auth::user()->hasPermission("administrator", "roles", "list", "partial")){
            $roles->where("roles.user_created_id", Auth::id());
            $isAccess = true;
        }else if(Auth::user()->hasPermission("administrator", "roles", "list", "total")){
            $isAccess = true;
        }

        if($isAccess){
            return view("administrator.roles.index")->with([
                "roles" => $roles->paginate(10)
            ]);
        }else{
            abort(403);
        }
    }

    public function create(): View {
        $this->authorize('hasPermission', ["administrator", 'roles', "create"]);

        $areasId = ModuleAreaPermission::select("area_id")->groupBy("area_id")->get();
        $areas = collect();
        foreach ($areasId as $areaId) {
            $areaData = $areaId->area()->first();
            $modulesId = ModuleAreaPermission::where("area_id", $areaData->id)->select("module_id")->groupBy("module_id")->get();
            $modules = collect();
            foreach ($modulesId as $moduleId) {
                $moduleData = $moduleId->module()->first();

                $permissionsId = ModuleAreaPermission::where(["area_id" => $areaData->id, "module_id" => $moduleData->id])->select("permission_id")->groupBy("permission_id")->get();
                $permissions = collect();
                foreach ($permissionsId as $permissionId) {
                    $permissionData = $permissionId->permission()->first();
                    $permissions->push($permissionData);
                }
                $moduleData->permissions = $permissions;
                $modules->push($moduleData);
            }

            $areaData->modules = $modules;

            $areas->push($areaData);
        }

        return view("administrator.roles.create", compact('areas'));

    }

    public function store(RoleRequest $request){
        $this->authorize('hasPermission', ["administrator", 'roles', "create"]);

        DB::beginTransaction();
        try {

            $role = new Role();
            $role->name = $request->name;
            $role->slug = $request->slug;

            $role->user_created_id = Auth::check() ? Auth::id() : 0;
            $role->status = 1;
            $role->save();

            $temp = collect();
            $updatedAreas = json_decode($request->updatedAreas);
            foreach ($updatedAreas as $data) {

                if(count($data->modulesId) > 0){
                    foreach ($data->modulesId as $moduleData) {
                        if(count($moduleData->permissionsId) > 0){
                            foreach ($moduleData->permissionsId as $permissionId) {
                                $temp->push([
                                    "role_id" => $role->id,
                                    "area_id" => $data->areaId,
                                    "module_id" => $moduleData->moduleId,
                                    "type_view_id" => $moduleData->typeViewId,
                                    "permission_id" => $permissionId
                                ]);
                            }
                        }else{
                            $temp->push([
                                "role_id" => $role->id,
                                "area_id" => $data->areaId,
                                "module_id" => $moduleData->moduleId,
                                "type_view_id" => $moduleData->typeViewId,
                                "permission_id" => null
                            ]);
                        }
                    }
                }else{
                    $temp->push([
                        "role_id" => $role->id,
                        "area_id" => $data->areaId,
                        "area_id" => null,
                        "module_id" => null,
                        "type_view_id" => null,
                        "permission_id" => null
                    ]);
                }
            }
            AccessDetail::insert($temp->toArray());

            DB::commit();
            return redirect()->route('administrator.roles.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput($request->all());
        }
    }


    public function edit($id){
        $role = Role::where(["id" => $id, "status" => 1])->first();

        $this->authorize('get', [$role , ["administrator", "roles", "get"]]);

        if($role){

            $areas = $this->areaService->getAreasDefault();
            $role->areas = $this->areaService->getAreasByRole($role);
            return view("administrator.roles.edit", compact('role', 'areas'));
        }else{
            abort(404);
        }
    }

    public function get($id){
        $role = Role::where(["id" => $id, "status" => 1])->first();

        $this->authorize('get', [$role , ["administrator", "roles", "get"]]);

        if($role){
            $areas = $this->areaService->getAreasDefault();
            $role->areas = $this->areaService->getAreasByRole($role);

            return response()->json($role, 200);
        }else{
            return response()->json([], 404);
        }
    }

    public function update(RoleRequest $request, $id){

        $role = Role::where(["id" => $id, "status" => 1])->first();
        $this->authorize('update', [$role , ["administrator", "roles", "update"]]);

        DB::beginTransaction();
        try {

            if($role){
                $role->name = $request->name;
                $role->slug = $request->slug;
                $role->user_updated_id = Auth::check() ? Auth::id() : 0;
                $role->save();

                AccessDetail::where("role_id", $role->id)->delete();

                $temp = collect();
                $updatedAreas = json_decode($request->updatedAreas);
                foreach ($updatedAreas as $data) {

                    if(count($data->modulesId) > 0){
                        foreach ($data->modulesId as $moduleData) {
                            if(count($moduleData->permissionsId) > 0){
                                foreach ($moduleData->permissionsId as $permissionId) {
                                    $temp->push([
                                        "role_id" => $role->id,
                                        "area_id" => $data->areaId,
                                        "module_id" => $moduleData->moduleId,
                                        "type_view_id" => $moduleData->typeViewId,
                                        "permission_id" => $permissionId
                                    ]);
                                }
                            }else{
                                $temp->push([
                                    "role_id" => $role->id,
                                    "area_id" => $data->areaId,
                                    "module_id" => $moduleData->moduleId,
                                    "type_view_id" => $moduleData->typeViewId,
                                    "permission_id" => null
                                ]);
                            }
                        }
                    }else{
                        $temp->push([
                            "role_id" => $role->id,
                            "area_id" => $data->areaId,
                            "area_id" => null,
                            "module_id" => null,
                            "type_view_id" => null,
                            "permission_id" => null
                        ]);
                    }
                }

                AccessDetail::insert($temp->toArray());

                DB::commit();
                return redirect()->route('administrator.roles.index');

            }else{
                DB::rollback();
                abort(404);
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput($request->all());
        }
    }

    public function delete($id){
        $role = Role::where(["id" => $id, "status" => 1])->first();

        if($role){
            $this->authorize('delete', [$role , ["administrator", "roles", "delete"]]);
        }else{
            abort(404);
        }

        DB::beginTransaction();
        try {
            $role->status = 2;
            $role->user_deleted_id = Auth::check() ? Auth::id() : 0;
            $role->deleted_at = Carbon::now();
            $role->save();

            DB::commit();
            return redirect()->route('administrator.roles.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('administrator.roles.index');
        }
    }
}
