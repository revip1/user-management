<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    
    public function index()
    {
        $users = User::all();
        return response()->json(['message' => 'Data User berhasil diambil', 'data' => $users], Response::HTTP_OK);
    }


    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'no_telepon' => 'required|digits_between:8,15',
            'status_aktif' => 'required|boolean',
            'department' => 'nullable|string|max:255',
        ]);
            $users = User::create($validated);
            return response()->json(['message' => 'User Berhasil dibuat', 'data' => $users], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User Gagal dibuat', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $users = User::findOrFail($id);
            $validated = $request->validate([
                'name' => 'string',
                'email' => 'email|unique:users,email,' . $users->id,
                'no_telepon' => 'digits_between:8,15',
                'status_aktif' => 'boolean',
                'department' => 'nullable|string|max:255',
            ]);
            $users->update($validated);
            return response()->json(['message' => 'User Berhasil diupdate', 'data' => $users], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User Gagal diupdate', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $users = User::findOrFail($id);
            $users->delete();
            return response()->json(['message' => 'User Berhasil dihapus'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User Gagal dihapus', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
