<?php

namespace App\View\Components\Dashboard\user\role\permission;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class Manage extends Component
{
    /**
     * Create a new component instance.
     */

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    // permissions
    public function handlePermission(User $user)
    {
        Gate::authorize('update-view-user-admin', [$user,'editor.user.update']);
        $permission = Permission::find(request('permission'));

        $user->givePermissionTo($permission);

        if(request()->ajax()){
            // axios
            return response()->json($permission);
        }else{
            // form
            return back();
        }
    }
    public function deletePermission(User $user){
        Gate::authorize('update-view-user-admin', [$user,'editor.user.update']);
        $permission = Permission::find(request('permission'));
        
        $user->revokePermissionTo($permission);

        if(request()->ajax()){
            // axios
            return 'ok';
        }else{
            // form
            return back();
        }
    }
    // roles
    public function handleRole(User $user)
    {
        Gate::authorize('update-view-user-admin', [$user,'editor.user.update']);
        $role = Role::find(request('role'));
        $user->assignRole($role);

        if(request()->ajax()){
            // axios
            return response()->json($role);
        }else{
            // form
            return back();
        }
    }

    public function deleteRole(User $user){
        Gate::authorize('update-view-user-admin', [$user,'editor.user.update']);
        $role = Role::find(request('role'));
        $user->removeRole($role);

        if(request()->ajax()){
            // axios
            return 'ok';
        }else{
            // form
            return back();
        }
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        return view('components.dashboard.user.role.permission.manage',[ 'roles' => Role::get(),'permissions' => Permission::get() ]);
    }
}
