<?php
namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Profile';
        $user = Auth::user();

        return view('personil.profile.index', compact('title', 'user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_user', 'public');
            $validated['foto'] = $foto;
        }

        $user->update($validated);

        return redirect()->route('admin.personil.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }

}
