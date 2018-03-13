<?php

namespace App\Http\Controllers\API;

use App\User;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;

class UsersController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->users;

        if ($request->has('user_type')) {
            $users = $users->where('user_type', $request->get('user_type'));
        }

        return response()->json($users->get());
    }

    /**
     * login from api
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            $user = auth()->user();
            $evaluations = User::with(['evaluations'])->find($user->id);

            return response([
                'status' => 'success',
                'items' => [
                    'user' => $user,
                    'evaluations' => $evaluations
                ]
            ]);
        }

        return response([
            'status' => 'error',
            'message' => 'Invalid credentials, please check your username/password',
            'items' => []
        ]);
    }
}
