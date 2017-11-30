<?php

namespace App\Http\Controllers\API;

use App\Code;
use App\Evaluation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvaluationsController extends Controller
{
    protected $evaluations;
    protected $codes;

    public function __construct(Evaluation $evaluations, Code $codes)
    {
        $this->codes = $codes;
        $this->evaluations = $evaluations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $evaluations = $this->evaluations;

        if ($request->has('form_id')) {
            $evaluations = $evaluations->where('form_id', $request->get('form_id'));
        }

        if ($request->has('includes')) {
            $includes = explode(',', $request->get('includes'));

            $evaluations = $evaluations->with($includes);
        }

        return response()->json($evaluations->get());
    }

    public function show($id, Request $request)
    {
        $evaluation = $this->evaluations->with('codes')->findOrFail($id);

        return response()->json($evaluation);
    }

    public function store(Request $request)
    {
        $evaluation = $this->evaluations->create([
            'user_id' => $request->input('user_id'),
            'form_id' => $request->input('form_id'),
            'code_count' => $request->input('code_count'),
        ]);

        for ($i=0; $i < $request->input('code_count'); $i++) { 
            $this->codes->create([
                'evaluation_id' => $evaluation->id,
                'token' => $this->quickRandom(10),
            ]);
        }

        return response()->json($evaluation);
    }

    private function quickRandom($length = 16)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
