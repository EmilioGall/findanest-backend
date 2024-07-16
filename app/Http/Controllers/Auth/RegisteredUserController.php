<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255', 'min:3', 'alpha'],
                'surname' => ['required', 'string', 'max:255', 'min:3', 'alpha'],
                'date_of_birth' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:' . now()->subYears(100)->toDateString()],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'name.required' => 'Il nome è obbligatorio.',
                'name.min' => 'Il nome deve avere almeno 3 caratteri',
                'name.alpha' => 'Il nome deve contenere solo lettere',
                'surname.required' => 'Il cognome è obbligatorio.',
                'surname.min' => 'Il cognome deve avere almeno 3 caratteri',
                'surname.alpha' => 'Il cognome deve contenere solo lettere',
                'date_of_birth.required' => 'La data di nascita è obbligatoria.',
                'date_of_birth.date' => 'La data di nascita deve essere una data valida.',
                'date_of_birth.before_or_equal' => 'La data di nascita deve essere una data prima o uguale a oggi.',
                'date_of_birth.after_or_equal' => 'La data di nascita deve essere una data dopo o uguale a 100 anni fa.',
                'email.required' => 'L\'email è obbligatoria.',
                'email.email' => 'L\'email deve essere un indirizzo email valido.',
                'email.unique' => 'L\'email è già stata presa.',
                'password.required' => 'La password è obbligatoria.',
                'password.confirmed' => 'Le password non coincidono.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
