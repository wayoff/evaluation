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
        $evaluation = Evaluation::findOrFail($evaluation_id);

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
            StudentAnswer::create([
                'answer_id' => $answer->id,
                'question_id' => $question->id,
                'value' => $request->input('question_' . $question->id)
            ]);
        }
        
        Alert::success('Success on evaluating professor');

        return redirect('/');
    }
}
