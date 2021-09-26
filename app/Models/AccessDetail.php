<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Role;
use App\Models\Module;
use App\Models\TypeView;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessDetail extends Model
{
    use HasFactory;


    protected $table = "access_detail";

    protected $fillable = [
        "role_id",
        "area_id",
        "module_id",
        "type_view_id"
    ];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function typeView(){
        return $this->belongsTo(TypeView::class);
    }

    public function permission(){
        return $this->belongsTo(Permission::class);
    }



}
