<?php

namespace App\Http\Controllers;

use Alert;
use App\Form;
use App\Question;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    protected $forms;
    protected $questions;

    public function __construct(Form $forms, Question $questions)
    {
        $this->forms = $forms;
        $this->questions = $questions;
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
        $form = $this->forms->create([
            'title' => $request->input('title')
        ]);

        $form->questions()->sync($request->input('questions'));

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
        $form = $this->forms->with('questions')->findOrFail($id);

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
            'title' => $request->input('title')
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
    }
}
