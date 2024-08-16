<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SendPasswordEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\UserInterface;


class UserController extends Controller
{
    
    private UserInterface $authInterface;
    public function __construct(UserInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function login(LoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->email,
        ];

        try {
            if ($this->authInterface->login($data))
                return redirect()->route('dashboard');
            else
                return back()->with('error', 'Email ou mot de passe incorrect(s).');
        } catch (\Exception $ex) {
            return back()->with('error', 'Une erreur est survenue lors du traitement, Réessayez !');
        }
    }

    public function loginView ()
    {

        return view('users/login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $password = Str::random(10);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($password),
        ]);

        // Mail::to($user->email)->send(new SendPasswordEmail($user, $password));

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }
    public function create(User $user)
    {
        // return view('users.create');
        return view('users.create', compact('user'));
    }

    public function index(User $user)
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
