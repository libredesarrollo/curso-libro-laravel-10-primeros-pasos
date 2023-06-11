<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Spatie\Permission\Models\Permission;

use App\Http\Requests\Permission\PutRequest;
use App\Http\Requests\Permission\StoreRequest;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Gate::authorize('is-admin');
        $permissions = Permission::paginate(10); // personaliza la paginacion como quieras
        return view('dashboard.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Gate::authorize('is-admin');
        $permission = new Permission();
        return view('dashboard.permission.create', compact('permission'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Gate::authorize('is-admin');
        Permission::create($request->validated());
        return to_route("permission.index")->with('status', "Registro actualizado.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission): View
    {
        Gate::authorize('is-admin');
        return view("dashboard.permission.show", compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission): View
    {
        Gate::authorize('is-admin');
        return view('dashboard.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Permission $permission): RedirectResponse
    {
        Gate::authorize('is-admin');
        $permission->update($request->validated());
        return to_route("permission.index")->with('status', "Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        Gate::authorize('is-admin');
        $permission->delete();
        return to_route("permission.index")->with('status', "Registro eliminado.");
    }
}
