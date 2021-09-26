<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Module;
use App\Models\TypeView;
use App\Models\ModuleRole;
use Illuminate\Support\Str;
use App\Models\AccessDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $table ="roles";


    public function accessDetail(){
        return $this->hasMany(AccessDetail::class);
    }


    public function scopeFiltered(Builder $builder) {
        $search = request('search');
        $sortBy = request('sortBy') ;
        $order = request('descending') == 'true' ? 'desc' : 'asc';
        $roles = $builder->select(
            'roles.id AS id',
            'roles.name AS name',
            'roles.slug AS slug',
            DB::raw('DATE_FORMAT(roles.created_at, "%d-%b-%Y") AS created_at_ft'),
            DB::raw('DATE_FORMAT(roles.updated_at, "%d-%b-%Y") AS updated_at_ft'),
            DB::raw('GROUP_CONCAT( DISTINCT areas.name) AS areas')
        );

        if ($search && strlen($search) > 0) {
            $listSearch = Str::of($search)->split('/[\s,]+/')->toArray();
            $search = count($listSearch) > 0 ? implode("%", $listSearch) : $search;
            $roles->whereRaw("CONCAT( IFNULL(roles.name,''),' ', IFNULL(roles.slug, '') ) LIKE '%{$search}%'");
        }

        $roles->where("roles.status", 1);

        $roles->join("access_detail", "roles.id", "=", "access_detail.role_id")
        ->join("areas", "access_detail.area_id", "=", "areas.id");

        if($sortBy != ""){
            $roles->orderBy($sortBy, $order);
        }

        $roles->groupBy("roles.id");
        $roles->groupBy("roles.name");
        $roles->groupBy("roles.slug");
        $roles->groupBy(DB::raw('DATE_FORMAT(roles.created_at, "%d-%b-%Y")'));
        $roles->groupBy(DB::raw('DATE_FORMAT(roles.updated_at, "%d-%b-%Y")'));
        return $roles;
    }
}
