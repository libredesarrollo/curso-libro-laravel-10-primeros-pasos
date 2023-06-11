<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

use App\Http\Requests\User\PutRequest;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        if (!Auth::user()->hasPermissionTo('editor.user.index')) {
            return abort(403);
        }

        //$users = User::paginate(10); // personaliza la paginacion como quieras

        // $users = User::query();

        $users = User::when(!Auth::user()->hasRole('Admin'), function ($query, $isAdmin) {
            return $query->where('rol', 'regular'); // regular = editor
        })->paginate(10);

        return view('dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        if (!Auth::user()->hasPermissionTo('editor.user.create')) {
            return abort(403);
        }

        $user = new User();
        return view('dashboard.user.create', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {

        if (!Auth::user()->hasPermissionTo('editor.user.create')) {
            return abort(403);
        }

        // User::create($request->validated());
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return to_route("user.index")->with('status', "Registro actualizado.");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        Gate::authorize('update-view-user-admin', [$user, 'editor.user.index']);

        return view("dashboard.user.show", compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        Gate::authorize('update-view-user-admin', [$user,'editor.user.update']);

        return view('dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, User $user): RedirectResponse
    {
        // $user->update($request->validated());
        Gate::authorize('update-view-user-admin', [$user,'editor.user.update']);
  
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return to_route("user.index")->with('status', "Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        Gate::authorize('update-view-user-admin', [$user,'editor.user.destroy']);

        $user->delete();
        return to_route("user.index")->with('status', "Registro eliminado.");
    }
}
