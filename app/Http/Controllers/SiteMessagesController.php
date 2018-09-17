<?php namespace App\Http\Controllers;

use App\Http\Requests\SiteMessagesRequests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;

use App\SiteMessage;

class SiteMessagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(SiteMessage $site_messages)
    {
        $site_messages = $site_messages->with('contacttypes')->paginate(12);

        return view('site_messages.index', compact('site_messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(SiteMessage $sitemessages)
    {
        return $sitemessages;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SiteMessage $sitemessages, SiteMessagesRequests $requests)
    {
        $sitemessages = $sitemessages->create($requests->all());
        
        return redirect()->route('contactus')
            ->withSuccess("Your message has been sent. Personnel from Dainsys will contact you!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(SiteMessage $site_message)
    {
        return view('site_messages.show', compact('site_message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(SiteMessage $sitemessages)
    {
        return $sitemessages;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(SiteMessage $sitemessages)
    {
        return $sitemessages;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(SiteMessage $sitemessages)
    {
        return $sitemessages;
    }
}
