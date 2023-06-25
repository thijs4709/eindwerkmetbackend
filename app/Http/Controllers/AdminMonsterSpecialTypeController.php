<?php

namespace App\Http\Controllers;

use App\Models\MonsterSpecialType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminMonsterSpecialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $monsterSpecialTypes = MonsterSpecialType::orderByDesc("id")->withTrashed()->paginate(10);

        return view('admin.monsterspecialtype.index',compact('monsterSpecialTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.monsterspecialtype.create');
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

        $monsterSpecialType = new MonsterSpecialType();

        $monsterSpecialType->name = $request->name;

        $monsterSpecialType->slug = Str::slug($request->name,'-');

        $monsterSpecialType->save();
        return redirect()->route('monsterspecialtype.index')->with([
            'alert' => [
                'message' => 'Monster Special Type added',
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
    public function edit(MonsterSpecialType $monsterSpecialType)
    {
        return view('admin.monsterspecialtype.edit',compact('monsterSpecialType'));
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
        $monsterSpecialType = MonsterSpecialType::findOrFail($id);
        $input = $request->all();
        $input['slug'] =  Str::slug($request->name,'-');


        $monsterSpecialType->update($input);

        return redirect()->route('monsterspecialtype.index')->with([
            'alert' => [
                'message' => 'Monster Special type updated',
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
        $monsterSpecialType = MonsterSpecialType::findOrFail($id);
        $monsterSpecialType->delete();
        return redirect()->route('monsterspecialtype.index')->with([
            'alert' => [
                'message' => 'Monster Special Type Deleted',
                'type' => 'danger'
            ]]);
    }
    public function monsterSpecialTypeRestore($id){
        MonsterSpecialType::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('monsterspecialtype.index')->with([
            'alert' => [
                'message' => 'Monster Special Type Restored',
                'type' => 'success'
            ]]);
    }
}
