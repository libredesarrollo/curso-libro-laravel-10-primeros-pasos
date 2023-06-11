<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Spatie\Permission\Models\Role;

use App\Http\Requests\Role\PutRequest;
use App\Http\Requests\Role\StoreRequest;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Gate::authorize('is-admin');
        $roles = Role::paginate(10); // personaliza la paginacion como quieras
        return view('dashboard.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Gate::authorize('is-admin');
        $role = new Role();
        return view('dashboard.role.create', compact('role'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Gate::authorize('is-admin');
        Role::create($request->validated());
        return to_route("role.index")->with('status', "Registro actualizado.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): View
    {
        Gate::authorize('is-admin');
        return view("dashboard.role.show", compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        Gate::authorize('is-admin');
        return view('dashboard.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Role $role): RedirectResponse
    {
        Gate::authorize('is-admin');
        $role->update($request->validated());
        return to_route("role.index")->with('status', "Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        Gate::authorize('is-admin');
        $role->delete();
        return to_route("role.index")->with('status', "Registro eliminado.");
    }
}
