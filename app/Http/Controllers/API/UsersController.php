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
            $evaluations = User::with(['evaluations.answers.studentAnswers.question', 'evaluations.form.questions'])->find($user->id);

            if ($user->isFaculty()) {
                return response([
                    'status' => 'success',
                    'items' => [
                        'user' => $user,
                        'evaluations' => $evaluations->evaluations
                    ]
                ]);
            }

            return response([
                'status' => 'error',
                'message' => 'You are not authorize to use this app',
                'items' => []
            ]);
        }

        return response([
            'status' => 'error',
            'message' => 'Invalid credentials, please check your username/password',
            'items' => []
        ]);
    }
}
