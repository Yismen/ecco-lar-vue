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
    function __construct() {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Note $notes, Request $request)
    {
        // Cache::forget('notes');
        $notes = Cache::rememberForever('notes', function() use($notes) {
            return $notes->get();
        });

        if ($request->ajax()) return $notes;
        
        return view('notes.admin.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Note $note, Request $request)
    {
        if ($request->ajax()) return $note;
        
        return view('notes.admin.create', compact('note'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Note $note)
    {
        $this->validate($request, [
            'title' => 'required|max:80|min:3|unique:notes',
            'body' => 'required|max:5000|min:3',
        ]);

        $note = $note->create($request->all());

        Cache::forget('notes');

        if ($request->ajax()) return $note;

        return redirect()->route('admin.notes.index')
        	->withSuccess("Your note $note->name has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note, Request $request)
    {
        if ($request->ajax()) return $note;        

        return view('notes.admin.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note, Request $request)
    {
        if ($request->ajax()) return $note; 

        return view('notes.admin.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $this->validate($request, [
            'title' => 'required|max:80|min:3',
            'body' => 'required|max:5000|min:3',
        ]);

        $note->update($request->all());

        Cache::forget('notes');
        
        if ($request->ajax()) return $note; 

        return redirect()->route('admin.notes.show', $note->slug)
            ->withSuccess("Note type $note->name has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note, Request $request)
    {
        $note->delete();

        Cache::forget('notes');

        if ($request->ajax()) return $note;
        
        return redirect()->route('admin.notes.index')
            ->withDanger("Note $note->name has been removed!");
    }

    /**
     * retrive all notes saved in the system.
     *
     * route:notes [this route does note require auth]
     * @param  Note   $notes  Notes Object
     * @param  Carbon $carbon Carbon instance
     * @return view         
     */
    public function getNotes(Note $notes, Carbon $carbon, Request $request)
    {
        $notes = $notes->get();

        if ($request->ajax()) {
            return $notes;
        }

        return view('notes.index', compact('notes'));
    }

    /**
     * Perform a search for the notes in the main view
     * Does not require auth.
     * @param  Request $request requests object
     * @param  Note    $notes   Notes model
     * @param  Search  $search  my search library
     * @return view           notes
     */
    public function searchNotes(Request $request, Note $notes, Search $search)
    {
        // $this->validate($request, [
        //     'search' => 'required|min:2',
        // ]);

        $notes = $search->find($notes, ['title', 'tags', 'body']);

        if ($request->ajax()) {
            return view('notes._results', compact('notes'));
        }

        return view('notes.index', compact('notes'));
    }

    public function trashedNotes(Note $notes)
    {
        $notes = $notes->onlyTrashed()->get();

        return view('notes.admin.trashed', compact('notes'));
    }

    public function restoreNotes($slug)
    {
        $note = Note::withTrashed()->whereSlug($slug)->firstOrFail();

        $note->restore();

        return redirect()->back()
            ->withSuccess("Note $note->title has been restored");


    }
}
