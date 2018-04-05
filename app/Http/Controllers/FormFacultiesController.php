<?php

namespace App\Http\Controllers;

use Alert;
use PDF;
use App\Form;
use App\User;
use App\Evaluation;
use Illuminate\Http\Request;

class FormFacultiesController extends Controller
{
    protected $forms;
    protected $users;
    protected $evaluations;

    public function __construct(Form $forms, User $users, Evaluation $evaluations)
    {
        $this->forms = $forms;
        $this->users = $users;
        $this->evaluations = $evaluations;
    }

    public function index($id)
    {
        // $evaluations = $this->evaluations;
        $form = $this->forms->findOrFail($id);
        // $evaluations = $this->evaluations->where('form_id', )        

        // $faculties = 

        return view('forms.faculties.index', compact('form'));
    }
    
    public function create($id)
    {
        $form = $this->forms->findOrFail($id);

        $users = $this->users->faculty()->get();

        return view('forms.faculties.create', compact('form', 'users'));
    }

    public function show($id, $facultyId)
    {
        $form = $this->forms->findOrFail($id);

        $evaluation = $form->evaluations()->where('user_id', $facultyId)->with('answers.studentAnswers.question', 'answers.studentAnswers.category')->first();

        $answers = $evaluation->answers;

        $studentAnswers = collect();

        foreach ($answers as $answer) {
            $studentAnswers = $studentAnswers->merge($answer->studentAnswers);
        }

        return view('forms.faculties.show', compact('evaluation', 'form', 'studentAnswers', 'facultyId'));
    }

    public function pdf($id, $facultyId)
    {

        $form = $this->forms->findOrFail($id);
        $user = User::find($facultyId);

        $evaluation = $form->evaluations()->where('user_id', $facultyId)->with('answers.studentAnswers.question', 'answers.studentAnswers.category')->first();

        $answers = $evaluation->answers;

        $studentAnswers = collect();

        foreach ($answers as $answer) {
            $studentAnswers = $studentAnswers->merge($answer->studentAnswers);
        }
        
        $pdf = PDF::loadView('pdf.forms-faculties', compact('evaluation', 'form', 'studentAnswers', 'user', 'answers'));

        return $pdf->stream();

        // return view('pdf.forms-faculties', compact('evaluation', 'form', 'studentAnswers'));
    }
}
