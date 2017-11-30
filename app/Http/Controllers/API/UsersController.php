<?php

namespace App\Http\Controllers\API;

use App\User;

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
}
