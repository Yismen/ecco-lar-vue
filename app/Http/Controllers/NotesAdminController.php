<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NotesAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:edit-notes', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-notes', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-notes', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notes = Note::get();

        if ($request->ajax()) {
            return $notes;
        }

        return view('notes.admin.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Note $note, Request $request)
    {
        if ($request->ajax()) {
            return $note;
        }

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
            'body' => 'required|min:3',
        ]);
        $note = $note->create($request->all());

        Cache::forget('notes');

        if ($request->ajax()) {
            return $note;
        }

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
        if ($request->ajax()) {
            return $note;
        }

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
        if ($request->ajax()) {
            return $note;
        }

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
            'body' => 'required|min:3',
        ]);

        $note->update($request->all());

        Cache::forget('notes');

        if ($request->ajax()) {
            return $note;
        }

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

        if ($request->ajax()) {
            return $note;
        }

        return redirect()->route('admin.notes.index')
            ->withDanger("Note $note->name has been removed!");
    }
}
