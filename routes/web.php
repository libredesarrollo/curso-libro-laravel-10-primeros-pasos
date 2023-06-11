<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\web\BlogController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name("dashboard");
    Route::resources([
        'post' => App\Http\Controllers\Dashboard\PostController::class,
        'category' => App\Http\Controllers\Dashboard\CategoryController::class,
        'user' => App\Http\Controllers\Dashboard\UserController::class,
        'role' => App\Http\Controllers\Dashboard\RoleController::class,
        'permission' => App\Http\Controllers\Dashboard\PermissionController::class,
    ]);
    // roles permisos
    Route::post('role/assign/permission/{role}',[ App\View\Components\Dashboard\role\permission\Manage::class, 'handle' ])->name('role.assign.permission');
    Route::delete('role/delete/permission/{role}',[ App\View\Components\Dashboard\role\permission\Manage::class, 'delete' ])->name('role.delete.permission');
    Route::post('role/delete/permission/{role}',[ App\View\Components\Dashboard\role\permission\Manage::class, 'delete' ])->name('role.delete.permission');
    // usuarios roles
    Route::post('user/assign/role/{user}',[ App\View\Components\Dashboard\user\role\permission\Manage::class, 'handleRole' ])->name('user.assign.role');
    Route::delete('user/delete/role/{user}',[ App\View\Components\Dashboard\user\role\permission\Manage::class, 'deleteRole' ])->name('user.delete.role');
    Route::post('user/delete/role/{user}',[ App\View\Components\Dashboard\user\role\permission\Manage::class, 'deleteRole' ])->name('user.delete.role');
    // usuarios permisos
    Route::post('user/assign/permission/{user}',[ App\View\Components\Dashboard\user\role\permission\Manage::class, 'handlePermission' ])->name('user.assign.permission');
    Route::delete('user/delete/permission/{user}',[ App\View\Components\Dashboard\user\role\permission\Manage::class, 'deletePermission' ])->name('user.delete.permission');
    Route::post('user/delete/permission/{user}',[ App\View\Components\Dashboard\user\role\permission\Manage::class, 'deletePermission' ])->name('user.delete.permission');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'blog'], function () {
    Route::controller(BlogController::class)->group(function () {
        Route::get('/', "index")->name('web.blog.index');
        Route::get('/detail/{post}', "show")->name('web.blog.show');
    });
});

Route::get('/test',function(){
    return [
        'Laravel' => app()->version()
    ];
});


require __DIR__.'/auth.php';
