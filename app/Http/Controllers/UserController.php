<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Hobby;
use App\Models\User;
// use Illuminate\Http\Request;
// use App\Http\Requests\User\Request as UserForRequest; //as for naming purpose
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $route = "admin.user";
    private $view = "admin.user"; //like php base path

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('hobbies')->paginate(10);
        return view("$this->view.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hobbies = Hobby::all(); // Fetch all hobbies
        return view("$this->view.create", compact('hobbies'));

        //compact and $data is same compact use is variable to create array
        // $data = ['hobbies' => $hobbies];  
        //return view('add', $data)

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(UserRequest $request)
    {
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phoneNumber' => $request->phoneNumber,
            'gender' => $request->gender,
            'country' => $request->country,
            'state' => $request->state,
            // 'profilePicture' => $request->file('profilePicture')->getClientOriginalName(),
        ]);
        $user->hobbies()->attach($request->hobbies ?? []);

        return redirect()->route('users.index')->with('success', 'Your Changes Successfully Changed')->response()->json(['message' => 'Form submitted successfully!']);

        // return redirect()->route('users.index')->with('success', 'Your Changes Successfully Changed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::findOrFail($id); //findOrFail - if user search wrong id 404 redirection
        return view("$this->view.view-user", compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view("$this->view.edit", compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::where('id', $id)
            ->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phoneNumber' => $request->phoneNumber,
                'country' => $request->country,
                'state' => $request->state,
                // 'profilePicture' => $request->file('profilePicture')->getClientOriginalName(),
            ]);
        $user->hobbies()->attach($request->input('hobbies', []));

        return redirect()->route("$this->view.index")->with('success', 'Your Changes Successfully Changed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);  //multiple data delete at a time 

        return redirect()->route("$this->view.index");
    }
}
