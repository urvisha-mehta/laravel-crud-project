<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use App\Http\Requests\User\Request as UserRequest; //as for naming purpose
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use App\Models\State;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $route = "admin.user";
    private $view = "admin.user"; //like php base path

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        $countries = Country::get();
        // $states = State::get();
        return view("$this->view.index", ['users' => $users, 'countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hobbies = Hobby::all(); // Fetch all hobbies
        $countries = Country::get();
        return view("$this->view.create", ['user' => $hobbies, 'countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            // 'profilePicture' => $request->file('profilePicture')->getClientOriginalName(),
        ]);
        $user->hobbies()->attach($request->hobbies ?? []);
        return response()->json(['redirect' => route('users.index')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id); //findOrFail - if user search wrong id 404 redirection
        return view("$this->view.view-user", ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        $userHobbies = $user->hobbies->pluck('id')->toArray();
        $countries = Country::get();
        return view("$this->view.edit", ['user' => $user, 'userHobbies' => $userHobbies, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $request->validate([
            'hobbies' => 'array',
        ]);

        $user = User::where('id', $id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                // 'profilePicture' => $request->file('profilePicture')->getClientOriginalName(),
            ]);
        $user = User::findOrFail($id);
        $user->hobbies()->sync($request->hobbies);
        return response()->json(['redirect' => route('users.index')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        User::destroy($id);  //multiple data delete at a time 

        return redirect()->route('users.index');
    }
}
