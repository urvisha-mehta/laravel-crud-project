<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\Request as UserForRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $route = "admin.user";
    private $view = "admin.user";

    public function index()
    {
        $users = User::with('hobbies')->get();
        return view("$this->view.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hobbies = Hobby::all(); // Fetch all hobbies
        return view('admin.user.create', compact('hobbies'));

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
            'profilePicture' => $request->file('profilePicture')->getClientOriginalName(),
        ]);
        $user->hobbies()->attach($request->hobbies ?? []);

        $response = [];
        if ($user) {
            $response['status'] = 'success';
            $response['message'] = 'Data Inserted Successfully';
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            // exit;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error : Something Wrong, Please Try Again';
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            // exit;
        }
        // return redirect()->route('users.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::findOrFail($id); //findOrFail - if user search wrong id 404 redirection
        return view('view-user', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('update', compact('users'));
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
                'profilePicture' => $request->file('profilePicture')->getClientOriginalName(),
            ]);
        $user->hobbies()->attach($request->input('hobbies', []));



        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);  //multiple data delete at a time 

        return redirect()->route('users.index');
    }
}
