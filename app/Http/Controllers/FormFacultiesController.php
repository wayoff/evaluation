<?php

namespace App\Http\Controllers;

use Alert;
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
}
