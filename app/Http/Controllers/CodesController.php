<?php

namespace App\Http\Controllers;

use PDF;
use App\Code;
use Illuminate\Http\Request;

class CodesController extends Controller
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

    public function download(Request $request, Code $codes)
    {
        if ($request->has('evaluation_id')) {
            $codes = $codes->where('evaluation_id', $request->get('evaluation_id'));
        }

        $codes = $codes->get();

        $pdf = PDF::loadView('pdf.codes', compact('codes'));

        return $pdf->download('codes.pdf');
    }
}
