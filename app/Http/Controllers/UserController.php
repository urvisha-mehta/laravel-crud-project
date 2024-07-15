<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use App\Http\Requests\User\Request as UserRequest; //as for naming purpose
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $route = "admin.user";
    private $view = "admin.user"; //like php base path

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query();
        $isActive = true;
        if ($request->is_active == "false") {
            $isActive = false;
        }
        $users = User::where('status', $isActive)->paginate(10);

        return view("$this->view.index", ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view("$this->view.create", ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $path = $request->file('profile_picture')->store('images', 'public');
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'profile_picture' => $path,
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
        $hobbies = Hobby::get();
        $userHobbiesId = $user->hobbies->pluck('id')->toArray();
        $countries = Country::get();
        return view("$this->view.edit", ['user' => $user, 'hobbies' => $hobbies, 'userHobbiesId' => $userHobbiesId, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $inputData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
        ];

        if (!empty($request->password)) {
            $inputData['password'] = Hash::make($request->password);
        }

        $user = User::where('id', $id)
            ->update($inputData);
        $user = User::findOrFail($id);
        $user->hobbies()->sync($request->hobbies);

        if (!empty($request->profile_picture)) {
            if ($request->hasFile('profile_picture')) {
                $path = public_path("storage/") . $user->profile_picture;
                if (file_exists($path)) {
                    @unlink($path);
                }

                $path = $request->profile_picture->store('images', 'public');
                $user->profile_picture = $path;
                $user->save();
            }
        }
        return response()->json(['redirect' => route('users.index')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user =  User::findOrFail($id);  //multiple data delete at a time 
        $user->delete();

        $path = public_path("storage/") . $user->profile_picture;
        if (file_exists($path)) {
            @unlink($path);
        }

        return redirect()->route('users.index');
    }
}
