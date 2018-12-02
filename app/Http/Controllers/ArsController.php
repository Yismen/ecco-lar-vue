<?php
namespace App\Http\Controllers;

use App\Ars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view_ars|edit_ars|create_ars', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit_ars', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create_ars', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy_ars', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arss = Cache::rememberForever('arss', function() {
            return Ars::with(['employees' => function ($query) {
                return $query->actives();
            }])->orderBy('name')->get();
        });

        if ($request->ajax()) {
            return $arss;
        }

        return view('ars.index', compact('arss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ars $ars)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:arss'
        ]);

        $ars = $ars->create($request->all());

        Cache::forget('employees');
        Cache::forget('arss');

        if ($request->ajax()) {
            return $ars;
        }

        return redirect()->route('admin.ars.index')
            ->withSuccess("ARS $ars->name created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Ars $ars
     * @return \Illuminate\Http\Response
     */
    public function show(Ars $ars)
    {
        return view('ars.show', compact('ars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Ars $ars
     * @return \Illuminate\Http\Response
     */
    public function edit(Ars $ars)
    {
        return view('ars.edit', compact('ars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Ars $ars
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ars $ars)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:arss,name,' . $ars->id
        ]);

        $ars->update($request->only(['name']));

        return redirect()->route('admin.ars.index')
            ->withSuccess("ARS $ars->name Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Ars $ars
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ars $ars)
    {
        $ars->delete();

        return redirect()->route('admin.ars.index')
            ->withDanger("ARS $ars->name have been eliminated!");
    }
}
