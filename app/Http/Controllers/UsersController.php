<?php

namespace App\Http\Controllers;

use Excel;
use App\User;

use Illuminate\Http\Request;
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
        $q = $request->input('q');

        if ($request->input('q')) {
            $users = $users
                        ->where('name', 'like', '%' . $q . '%')
                        ->orWhere('id', 'like', '%' . $q . '%')
                        ->orWhere('username', 'like', '%' . $q . '%');
        }

        $users = $users->orderBy('id', 'desc')->paginate(20);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = $this->users->faculty()->get();

        return view('users.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->users->create($request->all());

        return redirect()->back();
    }

    public function import(Request $request)
    {
        Excel::load($request->file('list'), function($reader) {
            $users = [];

            // Getting all results
            $results = $reader->get();

            foreach($results as $result) {
                $user = [
                    'username' => $result->student_number,
                    'password' => bcrypt($result->last_name . '321'),
                    'user_type' => 3,
                    'first_name' => $result->first_name,
                    'last_name' => $result->last_name,
                    'middle_name' => $result->middle_name,
                    'student' => [
                        'student_no' => $result->student_number,
                        'academic_attended' => $result->division,
                        'yr_level' => $result->year_level,
                        'strands' => $result->strands,
                        'course' => $result->course
                    ],
                    'faculties' => [],
                ];

                $faculties = [
                    'teacher_1',
                    'teacher_2',
                    'teacher_3'
                ];

                foreach ($faculties as $faculty) {
                    if (!empty($result[$faculty])) {
                        $last_name = explode(', ', $result[$faculty])[0];
                        $first_name = explode(', ', $result[$faculty])[1];

                        $facultyModel = $this->users->where('last_name', $last_name)->where('first_name', $first_name)->first();

                        if (!empty($facultyModel)) {
                            $user['faculties'][] = $facultyModel->id;
                        }
                    }
                }

                $users[] = $user;
            }

            dd($users);

        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->users->findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->users->findOrFail($id);
        $faculties = $this->users->faculty()->get();

        return view('users.edit', compact('user', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->users->findOrFail($id);

        $user->update([
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'department' => $request->input('department'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);

        if($user->isStudent()) {
            $user->student()->update([
                'student_no' => $request->input('student_no'),
                'academic_attended' => $request->input('academic_attended'),
                'yr_level'=> $request->input('yr_level'),
                'strands'=> $request->input('strands'),
                'course'=> $request->input('course'),
            ]);
            $user->student->professors()->sync($request->input('professor_id'));
        }

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->users->findOrFail($id);

        $user->delete();
        
        return redirect('users');
    }
}
