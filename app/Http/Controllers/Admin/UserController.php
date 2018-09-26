<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserEditRequest;
use App\Models\Admin\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);

        return view('admin.users.index', ['users' => $users]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', ['user' => $user]);

    }

    public function update(UserEditRequest $request)
    {
        $user = User::findOrFail($request->get('id'));
        if ($request->get('new_password')) {
            $user->changeUserPassword($request);

            return redirect()->back();
        } else {
            if ($user->updateUser($request)) {
                return redirect('admin/users')->with('success', 'Пользователь ' . $user->name . ' успешно изменен.');
            }
        }

        return redirect('admin/users')->with('error', 'Ошибка');
    }

    public function create()
    {
        $user = new User();

        return view('admin.users.edit', ['user' => $user]);

    }

    public function store(UserEditRequest $request)
    {
        $user = new User();
        if ($user->createUser($request)) {
            return redirect('admin/users')->with('success', 'Пользователь ' . $user->name . ' успешно создан.');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(User::all()->count() > 1) {
            if ($user->delete()) {
                return redirect('admin/users')->with('success', 'Пользователь ' . $user->name . ' удален.');
            }
        }
        return redirect('admin/users')->with('error', 'Пользователь ' . $user->name . ' не может быть удален, так как он является одним пользователем в системе.');
    }

}
