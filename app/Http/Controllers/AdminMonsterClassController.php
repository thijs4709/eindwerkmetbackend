<?php

namespace App\Http\Controllers;

use App\Models\MonsterClass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminMonsterClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $monsterClasses = MonsterClass::orderByDesc("id")->withTrashed()->paginate(10);

        return view('admin.monsterclass.index',compact('monsterClasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.monsterclass.create');
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

        $monsterClass = new MonsterClass();

        $monsterClass->name = $request->name;

        $monsterClass->slug = Str::slug($request->name,'-');

        $monsterClass->save();
        return redirect()->route('monsterclass.index')->with([
            'alert' => [
                'message' => 'Monster class added',
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
    public function edit(MonsterClass $monsterClass)
    {
        return view('admin.monsterclass.edit',compact('monsterClass'));
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
        $monsterClass = MonsterClass::findOrFail($id);
        $input = $request->all();
        $input['slug'] =  Str::slug($request->name,'-');


        $monsterClass->update($input);

        return redirect()->route('monsterclass.index')->with([
            'alert' => [
                'message' => 'Monster class updated',
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
        $monsterClass = MonsterClass::findOrFail($id);
        $monsterClass->delete();
        return redirect()->route('monsterclass.index')->with('status', 'Monster Class deleted!');
    }
    public function monsterClassRestore($id){
        MonsterClass::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('monsterclass.index')->with('status', 'Monster class restored!');
    }
}
