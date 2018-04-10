<?php

namespace App\Http\Controllers;

use Alert;
use Excel;
use Hash;
use Auth;
use App\User;
use App\Student;
use App\Evaluation;
use App\Answer;

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
                        ->where('last_name', 'like', '%' . $q . '%')
                        ->orWhere('first_name', 'like', '%' . $q . '%')
                        ->orWhere('middle_name', 'like', '%' . $q . '%')
                        ->orWhere('id', 'like', '%' . $q . '%')
                        ->orWhere('username', 'like', '%' . $q . '%')
                        ->orWhere('trimester', 'like', '%' . $q . '%');
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
    {   $users = [];

        Excel::load($request->file('list'), function($reader) use($users) {
            // Getting all results
            $results = $reader->get();
            foreach($results as $result) {
                $user = [
                    'username' => $result->student_number,
                    'password' => bcrypt($result->password),
                    'user_type' => 3,
                    'first_name' => $result->first_name,
                    'last_name' => $result->last_name,
                    'middle_name' => $result->middle_name,
                    'trimester' => $result->trimester,
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
                    'teacher_3',
                    'teacher_4',
                    'teacher_5',
                    'teacher_6',
                    'teacher_7',
                    'teacher_8',
                    'teacher_9',
                    'teacher_10',
                ];

                foreach($faculties as $faculty) {
                    if (!empty($result[$faculty])) {
                        $user['faculties'][] = $result[$faculty];
                    }
                }

                $users[] = $user;
            }

            $users = collect($users);
            
            $usernames = $users->pluck('username')->all();

            $exists = $this->users->whereIn('username', $usernames)->get();

            if (!$exists->isEmpty()) {

               return Alert::error('username\'s already exists:' . $exists->implode('username', ','));
                // return redirect('/users');
            }

            foreach($users as $user) {
                $userModel = $this->users->create([
                    'username' => strval($user['username']),
                    'password' =>  $user['password'],
                    'user_type' =>  $user['user_type'],
                    'first_name' =>  $user['first_name'],
                    'last_name' =>  $user['last_name'],
                    'middle_name' =>  $user['middle_name'],
                    'trimester' => $user['trimester'],
                    'department' => null,
                ]);

                // $student = Student::create([
                //     'user_id' => $userModel->id,
                //     // 'student_no' => $user['student']['student_no'],
                //     // 'academic_attended' => $user['student']['academic_attended'],
                //     // 'yr_level' => $user['student']['yr_level'],
                //     // 'strands' => $user['student']['strands'],
                //     // 'course' => $user['student']['course'],
                //     'student_no' => 'cacheeeee',
                //     'academic_attended' => 'cacheeeee',
                //     'yr_level' => 'cacheeeee',
                //     'strands' => 'cacheeeee',
                //     'course' => 'cacheeeee',
                // ]);

                $student = new Student();
                $student->user_id = $userModel->id;
                $student->student_no = $user['student']['student_no'];
                $student->academic_attended = 'cacheeeee';
                $student->yr_level = 'cacheeeee';
                $student->strands = 'cacheeeee';
                $student->course = 'cacheeeee';
                $student->save();

                $student->professors()->sync($user['faculties']);

                $this->updateStudent([
                    'student_no' => $user['student']['student_no'],
                    'academic_attended' => $user['student']['academic_attended'],
                    'yr_level' => $user['student']['yr_level'],
                    'strands' => $user['student']['strands'],
                    'course' => $user['student']['course'],
                    'professor_id' => $user['faculties']
                ], $userModel);

            }

            Alert::success('Success on importing students');

        });

        return redirect('/users');

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
            'trimester' => $request->input('trimester'),
            'department' => $request->input('department'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);

        if($user->isStudent()) {
            $this->updateStudent($request->all(), $user);
        }

        return redirect('users');
    }

    private function updateStudent($data, $user) {
        $user->student()->update([
            'student_no' => $data['student_no'],
            'academic_attended' => $data['academic_attended'],
            'yr_level'=> $data['yr_level'],
            'strands'=> !empty($data['strands']) ? $data['strands'] : '',
            'course'=> !empty($data['course']) ? $data['course'] : '',
        ]);
        $user->student->professors()->sync($data['professor_id']);
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

    public function changePassword(Request $request)
    {
        return view('users.change-password');
    }

    public function updatePassword(Request $request)
    {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        Alert::success('Password changed successfully !');
 
        return redirect()->back();
    }

    public function deleteStudents()
    {
        $users = $this->users->where('user_type', 3)->get();

        $usersId = $users->pluck('id');

        Student::truncate();
        Evaluation::whereIn('user_id', $usersId)->delete();
        Answer::whereIn('user_id', $usersId)->delete();
        $this->users->where('user_type', 3)->delete();
        Alert::success('Deleted all students!');

        return redirect()->back();
    }
}
