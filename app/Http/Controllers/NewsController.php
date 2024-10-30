<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'list all news';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'show create news form';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'show create news form';

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  'show specific news -' .$id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return  'delete the news'.$id;
        return 'news ' . $id . ' deleted'

    }
}
