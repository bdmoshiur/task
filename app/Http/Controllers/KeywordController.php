<?php

namespace App\Http\Controllers;

use App\Models\keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keywords.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
  
        Keyword::create($request->all());
   
        return redirect()->back()->with('success','keyword created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(keyword $keyword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(keyword $keyword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, keyword $keyword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(keyword $keyword)
    {
        //
    }
}
