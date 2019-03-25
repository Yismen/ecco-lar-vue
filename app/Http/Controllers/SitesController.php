<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;
use Cache;

class SitesController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorize:view-sites|edit-sites|create-sites', ['only' => ['index', 'show']]);
        $this->middleware('authorize:edit-sites', ['only' => ['edit', 'update']]);
        $this->middleware('authorize:create-sites', ['only' => ['create', 'store']]);
        $this->middleware('authorize:destroy-sites', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sites = Cache::remember('sites', 60, function() {
            return Site::get();
        });

        return view('sites.index', compact('sites'));
    }

    public function create()
    {
        return view('sites.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sites'
        ]);

        $site = Site::create($request->only(['name']));

        Cache::forget('sites');

        return redirect()->route('admin.sites.index')
            ->withSuccess('Site '. $site->name . ' has been created!');
    }

    public function show(Site $site)
    {
        return view('sites.show', compact('site'));
    }

    public function edit(Site $site)
    {
        return view('sites.edit', compact('site'));
    }

    public function update(Site $site, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sites,name,'.$site->id,
        ]);

        $site->update($request->only(['name']));

        Cache::forget('sites');

        return redirect()->route('admin.sites.index')
            ->withSuccess('Site '. $site->name . ' has been updated!');

    }
}