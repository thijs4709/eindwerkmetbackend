<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminBoxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $boxes = Box::with('photo')->orderByDesc("id")->withTrashed()->paginate(10);

        return view('admin.boxes.index',compact('boxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.boxes.create');
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
            'price'=>['required','numeric','min:0.01','regex:/^\d+(,\d{1,2})?(\.\d{1,2})?$/'],
            'photo_id'=>['required'],
            'description'=>['required'],
        ],
            [
                'name.required'=> 'Name is required',
                'name.between' => 'Name between 5 and 255 characters required',
                'name.unique'=> 'Name must be unique',
                'price.required'=>'Price is required',
                'price.numeric'=>'Price can only be a number',
                'price.regex'=>'test',
                'photo_id.required'=>'you must add a image',
                'description'=>'Description is required',
            ]);

        $box = new Box();

        $box->name = $request->name;
        $box->description = $request->description;
        $box->price = $request->price;
        $box->slug = Str::slug($request->name,'-');
        if ($file = $request->file("photo_id")) {
            $path = request()
                ->file("photo_id")
                ->store("boxes");

            $photo = Photo::create(["file" => $path]);
            //update photo_id (FK in users table)
            $box->photo_id = $photo->id;
        }

        $box->save();
        return redirect()->route('boxes.index')->with([
            'alert' => [
                'message' => 'Box added',
                'type' => 'success'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Box $box)
    {
        return view('admin.boxes.show', compact('box'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Box $box)
    {
        return view('admin.boxes.edit',compact('box'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name'=> ['required','between:1,255', Rule::unique('boxes')->ignore($id),],
            'price'=>['required','numeric','min:0.01','regex:/^\d+(,\d{1,2})?(\.\d{1,2})?$/'],
            'description'=>['required'],
        ],
            [
                'name.required'=> 'Name is required',
                'name.between' => 'Name between 5 and 255 characters required',
                'name.unique'=> 'Name must be unique',
                'price.required'=>'Price is required',
                'price.numeric'=>'Price can only be a number',
                'price.regex'=>'test',
                'description'=>'Description is required',
            ]);
        $box = Box::findOrFail($id);
        $input = $request->all();
        $input['slug'] =  Str::slug($request->name,'-');
        // oude foto verwijderen
        //we kijken eerst of er een foto bestaat
        if ($request->hasFile('photo_id')) {
            $oldPhoto = $box->photo; // de huidige foto van de gebruiker
            $path = request()->file('photo_id')->store('boxes');
            if ($oldPhoto) {
                unlink(public_path($oldPhoto->file));
                // $oldPhoto->delete();
                $oldPhoto->update(['file'=>$path]);
                $input['photo_id'] = $oldPhoto->id;
            }else{
                $photo = Photo::create(['file' => $path]);
                $input['photo_id'] = $photo->id;
            }
        }

        $box->update($input);

        return redirect()->route('boxes.index')->with([
            'alert' => [
                'message' => 'Box updated',
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

        $box = Box::findOrFail($id);
        $box->delete();
        return redirect()->route('boxes.index')->with([
            'alert' => [
                'message' => 'Box Deleted',
                'type' => 'danger'
            ]]);
    }
    public function boxRestore($id){
        Box::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('boxes.index')->with([
            'alert' => [
                'message' => 'Box Restored',
                'type' => 'success'
            ]]);
    }
}
