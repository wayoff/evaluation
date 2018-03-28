<?php

namespace App\Http\Controllers;

use Alert;
use App\Answer;
use App\Evaluation;
use App\StudentAnswer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($evaluation_id)
    {
        $evaluation = Evaluation::with('form.questions', 'form.categories')->findOrFail($evaluation_id);

        return view('answers.create', compact('evaluation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($evaluation_id, Request $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'evaluation_id' => $evaluation_id,
            'comment' => $request->input('comment')
        ];

        $evaluation = Evaluation::findOrFail($evaluation_id);
        $answer = Answer::create($data);

        foreach ($evaluation->form->questions as $question) {

        }

        foreach ($evaluation->form->categories as $category) {
            foreach ($category->questions as $question) {
                StudentAnswer::create([
                    'answer_id' => $answer->id,
                    'question_id' => $question->id,
                    'category_id' => $category->id,
                    'value' => $request->input('question_' . $question->id)
                ]);
            }
        }
        
        Alert::success('Success on evaluating professor');

        return redirect('/');
    }

    /**
     * show student answers
     * @param  [type]  $answer_id [description]
     * @param  Request $request   [description]
     * @return [type]             [description]
     */
    public function show($answer_id, Request $request)
    {
        $answer = Answer::with('studentAnswers.question', 'user', 'evaluation.user')->findOrFail($answer_id);

        return view('answers.show', compact('answer'));
    }
}
