<?php

namespace App\Services;

use App\Models\Role;
use App\Models\AccessDetail;
use App\Models\ModuleAreaPermission;

class AreaService {

    public function getAreasDefault(){

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

        return $areas;
    }

    public function getAreasByRole(Role $role){
        $areasId = AccessDetail::where("role_id", $role->id)->select("area_id")->groupBy("area_id")->get();
        $areas = collect();
        foreach ($areasId as $areaId) {
            if($areaId->area_id){
                $areaData = $areaId->area()->first();
                $modulesId = AccessDetail::where(["role_id" => $role->id, "area_id" => $areaData->id])->select("module_id")->groupBy("module_id")->get();
                $modules = collect();
                foreach ($modulesId as $moduleId) {
                    if($moduleId->module_id){
                        $moduleData = $moduleId->module()->first();
                        $typeViewId = AccessDetail::where(["role_id" => $role->id, "area_id" => $areaData->id, "module_id" => $moduleData->id])->select("type_view_id")->groupBy("type_view_id")->first();
                        $moduleData->typeView = $typeViewId->typeView()->first();

                        $permissionsId = AccessDetail::where(["role_id" => $role->id, "area_id" => $areaData->id, "module_id" => $moduleData->id])->select("permission_id")->groupBy("permission_id")->get();
                        $permissions = collect();
                        foreach ($permissionsId as $permissionId) {
                            if($permissionId->permission_id){
                                $permissionData = $permissionId->permission()->first();
                                $permissions->push($permissionData);
                            }
                        }
                        $moduleData->permissions = $permissions;
                        $modules->push($moduleData);
                    }
                }

                $areaData->modules = $modules;

                $areas->push($areaData);
            }
        }

        return $areas;
    }
}
