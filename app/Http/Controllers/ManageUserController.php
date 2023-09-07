<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;

class ManageUserController extends Controller
{
    protected $viewDir = 'manageUsers.';

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Session::flash('menu-active', 'users');

        $users = User::select('id', 'name', 'email', 'degree', 'nip')->get();

        return view($this->viewDir . 'index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        Session::flash('menu-active', 'users');

        $user = User::find($id);

        return view('auth.register', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $user = UserDTO::updateUser($request, $id);

        if(!$user) return redirect()->back()->withErrors("message", "Gagal Dalam Mengubah Data User $request->name");

        return redirect()->back()->with("success", "Berhasil Mengubah Data User $request->name");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $user = User::find($id);
        $user->delete();

        if(!$user) return response()->json(['message' => 'Gagal Dalam Menghapus User'], 403);

        return response()->json(["success" => "Berhasil Menghapus User"], 200);
    }
}
