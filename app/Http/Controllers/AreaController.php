<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleAreaPermission;

class AreaController extends Controller
{
    //
    public function listSelect(){

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

        return response()->json(
            $areas
        , 200);
    }
}
