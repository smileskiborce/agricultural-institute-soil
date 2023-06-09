<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(Request $request): Response
    {
        $this->authorize('viewAny', User::class);

        $search = $request->get('search');

        $users = User::query()
            ->select('id', 'name', 'username', 'email', 'last_login')
            ->with('roles:id,name')
            ->search($search, ['name', 'username', 'email'], ['name', 'username', 'email'])
            ->paginate(20)
            ->withQueryString();

        $roles = Role::all();

        return Inertia::render('User/Index', compact('users', 'roles'));
    }

    /**
     * @throws AuthorizationException
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);
        DB::transaction(function () use ($request) {
            $user = User::query()
                ->create($request->validated());
            $user->syncRoles(Role::query()
                ->find($request->input('role_id')));
        });

        return back()->with('success', 'Успешно го креиравте корисникот');
    }

    /**
     * @throws AuthorizationException
     */
    public function update(User $user, UserRequest $request): RedirectResponse
    {
        $this->authorize('update', User::class);
        DB::transaction(function () use ($request, $user) {
            $user->fill($request->validated());
            $user->syncRoles(Role::query()
                ->find($request->input('role_id')));
            $user->save();
        });

        return back()->with('success', 'Успешно го изменивте избраниот корисник');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', User::class);

        if ($user->sentRehearsals()->exists() || $user->receivedAndTestedRehearsals()->exists()) {
            return back()->with('error', 'Избраниот корисник има дадени проби');
        }

        if ($user->sentDistributions()->exists() || $user->receivedAndTestedDistributions()->exists()) {
            return back()->with('error', 'Избраниот корисник има дадени распределби');
        }

        $user->delete();

        return back()->with('success', 'Успешно го избришавте избраниот корисник');
    }
}
