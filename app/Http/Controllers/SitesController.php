<?php

namespace App\Http\Controllers;

use App\Site;
use App\Employee;
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
        $sites = Cache::remember('sites', 60, function () {
            return Site::with(['employees' => function ($query) {
                return $query->orderBy('first_name')
                    ->orderBy('second_first_name')
                    ->orderBy('last_name')
                    ->orderBy('second_last_name')
                    ->actives();
            }])
            ->get();
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
            'name' => 'required|unique:sites',
        ]);

        $site = Site::create($request->only(['name']));

        Cache::forget('sites');

        return redirect()->route('admin.sites.index')
            ->withSuccess('Site '.$site->name.' has been created!');
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
            ->withSuccess('Site '.$site->name.' has been updated!');
    }

    public function assignEmployees(Request $request)
    {
        $this->validate($request, [
            'employee' => 'required|array',
            'site' => 'required|exists:sites,id',
        ], [
            'employee.required' => 'Select at least one employee!',
        ]);

        Cache::forget('sites');

        foreach ($request->employee as  $id) {
            $employee = Employee::whereId($id)->first();

            $employee->update(['site_id' => $request->site]);
        }

        return redirect()->route('admin.sites.index')
            ->withSuccess('Done!');
    }
}
