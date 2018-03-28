<?php

namespace App\Http\Controllers;

use Alert;
use App\Category;
use App\Question;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public $categories = null;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories->paginate(20);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Question $questions)
    {
        $questions = $questions->get();

        return view('categories.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = $this->categories->create([
            'title' => $request->input('title')
        ]);

        $category->questions()->sync($request->input('questions'));

        Alert::success('Success on adding new item');

        return redirect('/categories');
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
    public function edit($id, Question $questions)
    {
        $category = $this->categories->with('questions')->findOrFail($id);
        $questions = $questions->get();

        return view('categories.edit', compact('category', 'questions'));
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
        $category = $this->categories->findOrFail($id);
        $category->update([
            'title' => $request->input('title')
        ]);

        $category->questions()->sync($request->input('questions'));

        Alert::success('Success on updating item: ' . $category->title);

        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categories->findOrFail($id)->delete();

        Alert::success('Success on deleting item');
        return redirect()->back();
    }
}
