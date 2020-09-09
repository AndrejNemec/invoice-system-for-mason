<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Http\Requests\SaveItemRequest;
use App\Item;
use App\ProjectItem;
use App\Unit;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        $items = Item::paginate(10);

        return view('item.index')->with('items', $items);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $catalogs = Catalog::all();

        return view('item.create')->with('units', $units)->with('catalogs', $catalogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveItemRequest $request)
    {

        $item = Item::create($request->all());

        return redirect()->route('catalog.show', $item->catalog->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('item.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $units = Unit::all();
        $catalogs = Catalog::all();

        return view('item.edit')->with('item', $item)->with('units', $units)->with('catalogs', $catalogs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);

        $item->update($request->all());

        return redirect()->route('catalog.show', $item->catalog->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        ProjectItem::where('item_id', $item->id)->delete();

        $item->delete();

        return redirect(url()->previous());
    }
}
