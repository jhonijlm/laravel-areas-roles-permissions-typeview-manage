<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleAreaPermission extends Model
{
    use HasFactory;

    protected $table ="module_area_permission";

    protected $fillable = [
        "module_id",
        "area_id",
        "permission_id"
    ];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function permission(){
        return $this->belongsTo(Permission::class);
    }
}
