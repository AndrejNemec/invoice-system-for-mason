<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Http\Requests\SaveCatalogRequest;
use App\ProjectItem;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $catalogs = Catalog::all()->sortByDesc('created_at');

        return view('catalog.index')->with('catalogs', $catalogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCatalogRequest $request)
    {

        $catalog = Catalog::create($request->all());
        return view('catalog.show')->with('catalog', $catalog);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catalog = Catalog::findOrFail($id);
        return view('catalog.show')->with('catalog', $catalog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalog = Catalog::findOrFail($id);

        return view('catalog.edit')->with('catalog', $catalog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCatalogRequest $request, $id)
    {
        $catalog = Catalog::findOrFail($id);

        $catalog->update($request->all());

        return redirect('catalog');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catalog = Catalog::find($id);
        $catalog->items()->delete();
        $catalog->delete();

        return redirect('catalog');
    }
}
