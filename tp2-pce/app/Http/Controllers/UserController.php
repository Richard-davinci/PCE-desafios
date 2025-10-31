<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Listado de usuarios con filtros y orden.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $allowedSorts = ['name', 'email', 'role', 'created_at'];
        $sort = in_array($request->input('sort'), $allowedSorts) ? $request->input('sort') : 'created_at';
        $dir = strtolower($request->input('dir')) === 'asc' ? 'asc' : 'desc';

        $users = $query->orderBy($sort, $dir)
            ->paginate(10)
            ->withQueryString();

        $roles = User::query()->select('role')->distinct()->pluck('role');

        return view('user.index', [
            'users' => $users,
            'roles' => $roles,
            'sort' => $sort,
            'dir' => $dir,
        ]);
    }
}
