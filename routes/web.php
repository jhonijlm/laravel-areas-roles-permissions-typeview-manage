<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeViewController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->middleware("auth");

Route::get('/home', function () {
    // return redirect()->route('users.index');
})->middleware("auth");

Route::view("/login", "auth.login")->middleware("guest")->name("login");
Route::post("/login", [AuthController::class, "login"])->name("auth.login");
Route::post("/logout", [AuthController::class, "logout"])->name("auth.logout");


Route::name('administrator.')->prefix('administrator')->group(function () {
    Route::get('/', function () {
        return view('administrator.dashboard');
    })->middleware("auth")->name("dashboard");

    Route::get("/users", [UserController::class, "index"])->name("users.index");
    Route::get("/users/create", [UserController::class, "create"])->name("users.create");
    Route::post("/users/store", [UserController::class, "store"])->name("users.store");
    Route::get("/users/edit/{id}", [UserController::class, "edit"])->name("users.edit");
    Route::put("/users/update/{id}", [UserController::class, "update"])->name("users.update");
    Route::delete("/users/delete/{id}", [UserController::class, "delete"])->name("users.delete");

    // ROLES
    Route::get("/roles", [RoleController::class, "index"])->name("roles.index");
    Route::get("/roles/create", [RoleController::class, "create"])->name("roles.create");
    Route::post("/roles/store", [RoleController::class, "store"])->name("roles.store");
    Route::get("/roles/edit/{id}", [RoleController::class, "edit"])->name("roles.edit");
    Route::put("/roles/update/{id}", [RoleController::class, "update"])->name("roles.update");
    Route::delete("/roles/delete/{id}", [RoleController::class, "delete"])->name("roles.delete");

    // POSTS
    Route::get("/posts", [PostController::class, "index"])->name("posts.index");
    Route::get("/posts/create", [PostController::class, "create"])->name("posts.create");
    Route::post("/posts/store", [PostController::class, "store"])->name("posts.store");
    Route::get("/posts/edit/{id}", [PostController::class, "edit"])->name("posts.edit");
    Route::put("/posts/update/{id}", [PostController::class, "update"])->name("posts.update");
    Route::delete("/posts/delete/{id}", [PostController::class, "delete"])->name("posts.delete");
});

Route::name('manager.')->prefix('manager')->group(function () {
    Route::get('/', function () {
        return view('manager.dashboard');
    })->middleware("auth")->name("dashboard");

    // POSTS
    Route::get("/posts", [PostController::class, "index"])->name("posts.index");
    Route::get("/posts/create", [PostController::class, "create"])->name("posts.create");
    Route::post("/posts/store", [PostController::class, "store"])->name("posts.store");
    Route::get("/posts/edit/{id}", [PostController::class, "edit"])->name("posts.edit");
    Route::put("/posts/update/{id}", [PostController::class, "update"])->name("posts.update");
    Route::delete("/posts/delete/{id}", [PostController::class, "delete"])->name("posts.delete");
});

Route::name('employee.')->prefix('employee')->group(function () {
    Route::get('/', function () {
        return view('employee.dashboard');
    })->middleware("auth")->name("dashboard");

    // POSTS
    Route::get("/posts", [PostController::class, "index"])->name("posts.index");
    Route::get("/posts/create", [PostController::class, "create"])->name("posts.create");
    Route::post("/posts/store", [PostController::class, "store"])->name("posts.store");
    Route::get("/posts/edit/{id}", [PostController::class, "edit"])->name("posts.edit");
    Route::put("/posts/update/{id}", [PostController::class, "update"])->name("posts.update");
    Route::delete("/posts/delete/{id}", [PostController::class, "delete"])->name("posts.delete");
});


// API
// ROL DETAIL
Route::get("/api/roles/get/{id}", [RoleController::class, "get"])->name("roles.get");


// AREAS
Route::get('/api/areas/list-select', [AreaController::class, 'listSelect'])->name("areas.list-select");

// PERMISSIONS
Route::get('/api/permissions/list', [PermissionController::class, 'list'])->name("permissions.list");

// TYPE VIEW
Route::get('/api/type-view/list-select', [TypeViewController::class, 'list'])->name("type-view.list-select");
