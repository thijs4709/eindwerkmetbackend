<?php

namespace App\Http\Controllers;

use App\Models\MonsterType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminMonsterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $monsterTypes = MonsterType::orderByDesc("id")->withTrashed()->paginate(10);

        return view('admin.monstertype.index',compact('monsterTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.monstertype.create');
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

        $monsterType = new MonsterType();

        $monsterType->name = $request->name;

        $monsterType->slug = Str::slug($request->name,'-');

        $monsterType->save();
        return redirect()->route('monstertype.index')->with([
            'alert' => [
                'message' => 'Monster type added',
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
    public function edit(MonsterType $monsterType)
    {
        return view('admin.monstertype.edit',compact('monsterType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {

        request()->validate([
            'name'=> ['required','between:1,255', Rule::unique('boxes')->ignore($id),],
        ],
            [
                'name.required'=> 'Name is required',
                'name.between' => 'Name between 1 and 255 characters required',
                'name.unique'=> 'Name must be unique',
            ]);
        $monsterType = MonsterType::findOrFail($id);
        $input = $request->all();
        $input['slug'] =  Str::slug($request->name,'-');


        $monsterType->update($input);

        return redirect()->route('monstertype.index')->with([
            'alert' => [
                'message' => 'Monster type updated',
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
        $monsterType = MonsterType::findOrFail($id);
        $monsterType->delete();
        return redirect()->route('monstertype.index')->with('status', 'Monster type deleted!');
    }
    public function monsterTypeRestore($id){
        MonsterType::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('monstertype.index')->with('status', 'Monster type restored!');
    }
}
