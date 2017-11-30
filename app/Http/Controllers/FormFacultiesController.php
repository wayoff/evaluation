<?php

namespace App\Http\Controllers;

use Alert;
use App\Form;
use App\User;
use Illuminate\Http\Request;

class FormFacultiesController extends Controller
{
    protected $forms;
    protected $users;

    public function __construct(Form $forms, User $users)
    {
        $this->forms = $forms;
        $this->users = $users;
    }

    public function index($id)
    {
        $form = $this->forms->findOrFail($id);

        return view('forms.faculties.index', compact('form'));
    }
    
    public function create($id)
    {
        $form = $this->forms->findOrFail($id);

        $users = $this->users->faculty()->get();

        return view('forms.faculties.create', compact('form', 'users'));
    }
}
