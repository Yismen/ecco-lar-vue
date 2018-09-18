<?php

namespace App\Http\Controllers\Quality;

use App\QualityScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QualityScore $score)
    {
        $scores = $score->latest()->with(['auditor', 'employee', 'client'])->paginate(40);
        $score->append(['auditors_list', 'employees_list', 'clients_list']);

        return view('quality.scores.index', compact('scores', 'score'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'employee_id' => 'required',
           'client_id' => 'required',
           'work_date' => 'required|date',
           'score' => 'required|numeric|min:0|max:100',
        ]);

        // Extract to user
        $score = auth()->user()->createQualityScore($request);

        return redirect()->route('admin.quality_scores.index')
            ->withSuccess('Quality Score added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QualityScore  $qualityScore
     * @return \Illuminate\Http\Response
     */
    public function show(QualityScore $qualityScore)
    {
        return $qualityScore;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QualityScore  $qualityScore
     * @return \Illuminate\Http\Response
     */
    public function edit(QualityScore $qualityScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QualityScore  $qualityScore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QualityScore $qualityScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QualityScore  $qualityScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(QualityScore $qualityScore)
    {
        //
    }
}
