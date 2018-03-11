<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use App\Form;
use App\Question;
use App\Evaluation;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    protected $users;
    protected $forms;
    protected $questions;
    protected $evaluations;

    public function __construct(Form $forms, Question $questions, Evaluation $evaluations, User $users)
    {
        $this->users = $users;
        $this->forms = $forms;
        $this->questions = $questions;
        $this->evaluations = $evaluations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = $this->forms->with('questions')->paginate(20);

        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = $this->questions->all();

        return view('forms.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = $this->users->faculty()->get();

        $form = $this->forms->create([
            'title' => $request->input('title'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),    
        ]);

        $form->questions()->sync($request->input('questions'));

        foreach ($users as $user) {
            $this->evaluations->create([
                'user_id' => $user->id,
                'form_id' => $form->id
            ]);
        }

        Alert::success('Success on creating new form');

        return redirect(route('forms.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = $this->forms->with('questions', 'evaluations.user')->findOrFail($id);

        return view('forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = $this->forms->findOrFail($id);

        $questions = $this->questions->all();

        return view('forms.edit', compact('questions', 'form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = $this->forms->findOrFail($id);

        $form->update([
            'title' => $request->input('title'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        $form->questions()->sync($request->input('questions'));


        Alert::success('Success on updating form: ' . $form->title);

        return redirect(route('forms.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->forms->findOrFail($id)->delete();

        Alert::success('Success on removing form');

        return redirect(route('forms.index'));
    }
}
