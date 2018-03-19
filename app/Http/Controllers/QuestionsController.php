<?php

namespace App\Http\Controllers;

use Alert;
use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public $questions;

    public function __construct(Question $questions)
    {
        $this->questions = $questions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questions->paginate(20);

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = $this->questions->create([
            'title' => $request->input('title'),
            'description' => $request->input('title')
        ]);

        foreach ($request->input('choices') as $key => $answer) {
            $question->choices()->create([
                'decription' => $answer,
                'order' => $key + 1
            ]);
        }

        Alert::success('Success on adding new item');

        return redirect(route('questions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questions->with('choices')->findOrFail($id);

        return view('questions.edit', compact('question'));
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
        $question = $this->questions->findOrFail($id);

        $question->update([
            'title' => $request->input('title'),
            'description' => $request->input('title')
        ]);

        $question->choices()->delete();

        foreach ($request->input('choices') as $key => $answer) {
            $question->choices()->create([
                'decription' => $answer,
                'order' => $key + 1
            ]);
        }

        Alert::success('Success on updating item');

        return redirect(route('questions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->questions->find($id)->delete();

        Alert::success('Success on deleting item');

        return redirect(route('questions.index'));
    }
}