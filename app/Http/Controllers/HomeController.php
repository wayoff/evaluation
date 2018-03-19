<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Answer;
use App\Form;
use App\Evaluation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->user_type == 'student') {
            return redirect('/');
        }

        if (auth()->user()->user_type == 'faculty') {
            auth()->logout();
            return redirect('/');
        }

        $today = Carbon::now();

        $answers = Answer::with(['user', 'evaluation.form', 'evaluation.user'])->orderBy('created_at', 'desc')->limit(15)->get();
        $forms = Form::where('start_date', '<=', $today)->where('end_date', '>', $today)->get();

        return view('home', compact('answers', 'forms'));
    }
}
