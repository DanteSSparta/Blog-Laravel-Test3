<?php

namespace App\Http\Controllers;

use App\WordsFilter;
use Illuminate\Http\Request;

class WordsFilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
        $filters = WordsFilter::all();
        return view('filter.index', compact('filters'));
    }

    public function store()
    {
        WordsFilter::create([
            'word' => request('word')
        ]);

        session()->flash(
            'message', 'Filter word was added.'
        );
        return back();
    }

    public function destroy(WordsFilter $filter)
    {
        $filter->delete();

        return back();
    }
}
}
