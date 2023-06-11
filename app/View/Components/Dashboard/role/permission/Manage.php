<?php

namespace App\View\Components\Dashboard\role\permission;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Manage extends Component
{
    /**
     * Create a new component instance.
     */

    public $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function handle(Role $role){

        Gate::authorize('is-admin');
        $permission = Permission::find(request('permission'));
        $role->givePermissionTo($permission);

        if(request()->ajax()){
            //axios, jquery ajax fetch...
            return response()->json($permission);
        }else{
            //form
            return redirect()->back();
        }
    }

    public function delete(Role $role)
    {
        Gate::authorize('is-admin');
        $permission = Permission::find(request('permission'));
        $role->revokePermissionTo($permission);

        if(request()->ajax()){
            return 'ok';
        } else{
            return redirect()->back();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.role.permission.manage',['permissionsRole' => $this->role->permissions, 'permissions' => Permission::get() ]);
    }
}
