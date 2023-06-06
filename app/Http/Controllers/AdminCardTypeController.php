<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminCardTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cardTypes = CardType::orderByDesc("id")->withTrashed()->paginate(10);

        return view('admin.cardtype.index',compact('cardTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.cardtype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            'name'=> ['required','between:1,255','unique:boxes,name'],
        ],
            [
                'name.required'=> 'Name is required',
                'name.between' => 'Name between 1 and 255 characters required',
                'name.unique'=> 'Name must be unique',
            ]);

        $cardType = new CardType();

        $cardType->name = $request->name;

        $cardType->slug = Str::slug($request->name,'-');

        $cardType->save();
        return redirect()->route('cardtype.index')->with([
            'alert' => [
                'message' => 'Card type added',
                'type' => 'success'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(CardType $cardType)
    {
        return view('admin.cardtype.edit',compact('cardType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name'=> ['required','between:1,255', Rule::unique('boxes')->ignore($id),],
        ],
            [
                'name.required'=> 'Name is required',
                'name.between' => 'Name between 1 and 255 characters required',
                'name.unique'=> 'Name must be unique',
            ]);
        $cardType = CardType::findOrFail($id);
        $input = $request->all();
        $input['slug'] =  Str::slug($request->name,'-');


        $cardType->update($input);

        return redirect()->route('cardtype.index')->with([
            'alert' => [
                'message' => 'Card type updated',
                'type' => 'success'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cardType = CardType::findOrFail($id);
        $cardType->delete();
        return redirect()->route('cardtype.index')->with('status', 'Card type deleted!');
    }
    public function cardTypeRestore($id){
        CardType::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('cardtype.index')->with('status', 'Card type restored!');
    }
}
