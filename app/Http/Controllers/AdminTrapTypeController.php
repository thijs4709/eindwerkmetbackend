<?php

namespace App\Http\Controllers;

use App\Models\TrapType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminTrapTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $trapTypes = TrapType::orderByDesc("id")->withTrashed()->paginate(10);

        return view('admin.traptype.index',compact('trapTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.traptype.create');
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

        $trapType = new TrapType();

        $trapType->name = $request->name;

        $trapType->slug = Str::slug($request->name,'-');

        $trapType->save();
        return redirect()->route('traptype.index')->with([
            'alert' => [
                'message' => 'Trap type added',
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
    public function edit(TrapType $trapType)
    {
        return view('admin.traptype.edit',compact('trapType'));
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
        $trapType = TrapType::findOrFail($id);
        $input = $request->all();
        $input['slug'] =  Str::slug($request->name,'-');


        $trapType->update($input);

        return redirect()->route('traptype.index')->with([
            'alert' => [
                'message' => 'Trap type updated',
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
        $trapType = TrapType::findOrFail($id);
        $trapType->delete();
        return redirect()->route('traptype.index')->with([
            'alert' => [
                'message' => 'Trap Type Deleted',
                'type' => 'danger'
            ]]);
    }
    public function trapTypeRestore($id){
        TrapType::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('traptype.index')->with([
            'alert' => [
                'message' => 'Trap Type Restored',
                'type' => 'success'
            ]]);
    }
}
