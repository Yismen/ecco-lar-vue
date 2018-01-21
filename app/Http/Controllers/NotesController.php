<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Http\Requests;
use App\Note;
use App\Search;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $notes = Note::orderBy('title')->get();
            return $notes;
        }

        return view('notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Note $note, Request $request)
    {
        return $note->findOrFail($id);
    }

    /**
     * Perform a search for the notes in the main view
     * Does not require auth.
     * @param  Request $request requests object
     * @param  Note    $notes   Notes model
     * @param  Search  $search  my search library
     * @return view           notes
     */
    public function search(Request $request, Note $notes)
    {
        $notes = $notes->select('title', 'id')
                ->orWhere('title', 'like', "%{$request->search}%")
                ->orWhere('tags', 'like', "%{$request->search}%")
                // ->orWhere('body', 'like', "%{$request->search}%")
                ->orderBy('title')
                ->get();

        if ($request->ajax()) return $notes;

        return view('notes.index', compact('notes'));
    }
}
