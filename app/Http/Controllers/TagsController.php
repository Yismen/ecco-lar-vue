<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Tag;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_tags|edit_tags|create_tags', ['only'=>['index','show']]);
        $this->middleware('authorize:edit_tags', ['only'=>['edit','update']]);
        $this->middleware('authorize:create_tags', ['only'=>['create','store']]);
        $this->middleware('authorize:destroy_tags', ['only'=>['destroy']]);
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Tag $tags)
    {
        return $articles = $tags->orderBy('name', 'ASC')->paginate(10);

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return str_slug('Esta boca es mia.-/asdfasdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Tag $tag)
    {
        $articles = $tag->articles()->orderedDesc()->published()->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
