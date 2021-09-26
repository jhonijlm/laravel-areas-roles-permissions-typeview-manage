<?php

namespace App\Traits;

trait UserTrait {

    public function hasPermission($area, $module, $permission, $view = null){

        foreach ($this->roles()->get() as $role) {
            if($role->status == 1){
                $listAccessDetail = $role->accessDetail()->get();
                foreach ($listAccessDetail as $access) {
                    $areaData = $access->area()->first();
                    $moduleData = $access->module()->first();
                    $permissionData = $access->permission()->first();

                    if(
                        $areaData->slug == $area
                        && $moduleData->slug == $module
                        && $permissionData->slug == $permission
                    ){
                        if($view){
                            if($access->typeView()->first()->slug == $view){
                                return true;
                            }
                        }else{
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }
    public function hasRole($role){
        return $this->roles()->where(['slug' => $role, 'status' => 1])->exists();
    }

    public function hasArea($area){
        foreach ($this->roles()->get() as $role) {
            if($role->status == 1){
                foreach ($role->accessDetail()->select("area_id")->groupBy("area_id")->get() as $access) {
                    if($access->area()->first()->slug == $area){
                        return true;
                    }
                }
            }
        }
        return false;
    }

}
