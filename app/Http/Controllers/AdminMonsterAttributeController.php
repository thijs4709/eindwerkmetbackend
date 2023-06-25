<?php

namespace App\Http\Controllers;

use App\Models\MonsterAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminMonsterAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $monsterAttributes = MonsterAttribute::orderByDesc("id")->withTrashed()->paginate(10);

        return view('admin.monsterattribute.index',compact('monsterAttributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.monsterattribute.create');
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

        $monsterAttribute = new MonsterAttribute();

        $monsterAttribute->name = $request->name;

        $monsterAttribute->slug = Str::slug($request->name,'-');

        $monsterAttribute->save();
        return redirect()->route('monsterattribute.index')->with([
            'alert' => [
                'message' => 'Monster attribute added',
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
    public function edit(MonsterAttribute $monsterAttribute)
    {
        return view('admin.monsterattribute.edit',compact('monsterAttribute'));
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
        $monsterAttribute = MonsterAttribute::findOrFail($id);
        $input = $request->all();
        $input['slug'] =  Str::slug($request->name,'-');


        $monsterAttribute->update($input);

        return redirect()->route('monsterattribute.index')->with([
            'alert' => [
                'message' => 'Monster attribute updated',
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
        $monsterAttribute = MonsterAttribute::findOrFail($id);
        $monsterAttribute->delete();
        return redirect()->route('monsterattribute.index')->with([
            'alert' => [
                'message' => 'Monster Attribute Deleted',
                'type' => 'danger'
            ]]);
    }
    public function monsterAttributeRestore($id){
        MonsterAttribute::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('monsterattribute.index')->with([
            'alert' => [
                'message' => 'Monster Attribute Restored',
                'type' => 'success'
            ]]);
    }
}
