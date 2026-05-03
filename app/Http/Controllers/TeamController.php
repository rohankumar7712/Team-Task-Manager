<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $this->authorize('isAdmin', User::class);
        $members = User::all();
        return view('team.index', compact('members'));
    }

    public function create()
    {
        $this->authorize('isAdmin', User::class);
        return view('team.create');
    }

    public function store(Request $request)
    {
        $this->authorize('isAdmin', User::class);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'personal_email' => 'required|string|email|max:255|unique:users',
            'dob' => 'required|date',
            'role' => 'required|in:admin,member',
        ]);

        // Generate Company Email: slug(name)@taskflow.com
        $slug = \Illuminate\Support\Str::slug($validated['name']);
        $email = $slug . '@taskflow.com';
        
        // Ensure uniqueness for generated email
        $count = 1;
        while (User::where('email', $email)->exists()) {
            $email = $slug . $count . '@taskflow.com';
            $count++;
        }

        $password = \Illuminate\Support\Str::random(10);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $email,
            'personal_email' => $validated['personal_email'],
            'dob' => $validated['dob'],
            'role' => $validated['role'],
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'plain_password' => $password,
        ]);

        return redirect()->route('team.index')
            ->with('success', "Member created successfully!")
            ->with('generated_password', $password)
            ->with('generated_email', $user->email);
    }

    public function show(User $member)
    {
        $this->authorize('isAdmin', User::class);
        return view('team.show', compact('member'));
    }

    public function edit(User $member)
    {
        $this->authorize('isAdmin', User::class);
        return view('team.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $this->authorize('isAdmin', User::class);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $member->id,
            'personal_email' => 'required|string|email|max:255|unique:users,personal_email,' . $member->id,
            'dob' => 'required|date',
            'role' => 'required|in:admin,member',
            'plain_password' => 'required|string|min:8',
        ]);

        // If password changed, update hash
        if ($member->plain_password !== $validated['plain_password']) {
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['plain_password']);
        }

        $member->update($validated);

        return redirect()->route('team.index')->with('success', 'Member details updated successfully.');
    }

    public function destroy(User $member)
    {
        $this->authorize('isAdmin', User::class);
        
        if ($member->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $member->delete();
        return redirect()->route('team.index')->with('success', 'Member deleted successfully.');
    }
}
