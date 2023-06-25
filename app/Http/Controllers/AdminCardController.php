<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardStoreRequest;
use App\Http\Requests\CardUpdateRequest;
use App\Models\Card;
use App\Models\CardType;
use App\Models\MonsterAttribute;
use App\Models\MonsterClass;
use App\Models\MonsterSpecialType;
use App\Models\MonsterType;
use App\Models\Photo;
use App\Models\SpellType;
use App\Models\TrapType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cards = Card::with('photo', 'monsterAttribute', 'monsterClass', 'monsterSpecialType', 'monsterType', 'spellType', 'trapType', 'cardType')->orderByDesc("id")->withTrashed()->paginate(5);

        return view('admin.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $cardTypes = CardType::all();
        $monsterClasses = MonsterClass::all();
        $monsterAttributes = MonsterAttribute::all();
        $monsterSpecialTypes = MonsterSpecialType::all();
        $monsterTypes = MonsterType::all();
        $spellTypes = SpellType::all();
        $trapTypes = TrapType::all();
        return view('admin.cards.create', compact('cardTypes', 'monsterClasses', 'monsterAttributes', 'monsterSpecialTypes', 'monsterTypes', 'spellTypes', 'trapTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CardStoreRequest $request)
    {

        $card = new Card();

        $card['name'] = $request->name;
        $card['description'] = $request->description;
        $card['price'] = $request->price;
        $card['card_type_id'] = $request->card_type_id;

        if ($request->card_type_id == 1) {
            $card['atk'] = $request->atk;
            $card['def'] = $request->def;
            $card['level'] = $request->level;
            $card['pendulum'] = $request->pendulum;
            $card['monster_type_id'] = $request->monster_type_id;
            $card['monster_special_type_id'] = $request->monster_special_type_id;
            $card['monster_class_id'] = $request->monster_class_id;
            $card['monster_attribute_id'] = $request->monster_attribute_id;
            $card['spell_type_id'] = null;
            $card['trap_type_id'] = null;
        } elseif ($request->card_type_id == 2) {
            $card['atk'] = null;
            $card['def'] = null;
            $card['level'] = null;
            $card['pendulum'] = 0;
            $card['monster_type_id'] = null;
            $card['monster_special_type_id'] = null;
            $card['monster_class_id'] = null;
            $card['monster_attribute_id'] = null;
            $card['spell_type_id'] = $request->spell_type_id;
            $card['trap_type_id'] = null;
        } elseif ($request->card_type_id == 3) {
            $card['atk'] = null;
            $card['def'] = null;
            $card['level'] = null;
            $card['pendulum'] = 0;
            $card['monster_type_id'] = null;
            $card['monster_special_type_id'] = null;
            $card['monster_class_id'] = null;
            $card['monster_attribute_id'] = null;
            $card['spell_type_id'] = null;
            $card['trap_type_id'] = $request->trap_type_id;
        }

        $card->slug = Str::slug($request->name, '-');

        if ($file = $request->file("photo_id")) {
            $path = request()
                ->file("photo_id")
                ->store("cards");

            $photo = Photo::create(["file" => $path]);
            //update photo_id (FK in users table)
            $card->photo_id = $photo->id;
        }

        $card->save();
        return redirect()->route('cards.index')->with([
            'alert' => [
                'message' => 'Card added',
                'type' => 'success'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Card $card)
    {
        return view('admin.cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Card $card)
    {
        $cardTypes = CardType::all();
        $monsterClasses = MonsterClass::all();
        $monsterAttributes = MonsterAttribute::all();
        $monsterSpecialTypes = MonsterSpecialType::all();
        $monsterTypes = MonsterType::all();
        $spellTypes = SpellType::all();
        $trapTypes = TrapType::all();
        return view('admin.cards.edit', compact('cardTypes', 'monsterClasses', 'monsterAttributes', 'monsterSpecialTypes', 'monsterTypes', 'spellTypes', 'trapTypes', 'card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CardUpdateRequest $request, $id)
    {
        $card = Card::findOrFail($id);

        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['price'] = $request->price;
        $input['card_type_id'] = $request->card_type_id;

        if ($request->card_type_id == 1) {
            $input['atk'] = $request->atk;
            $input['def'] = $request->def;
            $input['level'] = $request->level;
            $input['pendulum'] = $request->pendulum;
            $input['monster_type_id'] = $request->monster_type_id;
            $input['monster_special_type_id'] = $request->monster_special_type_id;
            $input['monster_class_id'] = $request->monster_class_id;
            $input['monster_attribute_id'] = $request->monster_attribute_id;
            $input['spell_type_id'] = null;
            $input['trap_type_id'] = null;
        } elseif ($request->card_type_id == 2) {
            $input['atk'] = null;
            $input['def'] = null;
            $input['level'] = null;
            $input['pendulum'] = 0;
            $input['monster_type_id'] = null;
            $input['monster_special_type_id'] = null;
            $input['monster_class_id'] = null;
            $input['monster_attribute_id'] = null;
            $input['spell_type_id'] = $request->spell_type_id;
            $input['trap_type_id'] = null;
        } elseif ($request->card_type_id == 3) {
            $input['atk'] = null;
            $input['def'] = null;
            $input['level'] = null;
            $input['pendulum'] = 0;
            $input['monster_type_id'] = null;
            $input['monster_special_type_id'] = null;
            $input['monster_class_id'] = null;
            $input['monster_attribute_id'] = null;
            $input['spell_type_id'] = null;
            $input['trap_type_id'] = $request->trap_type_id;
        }

        $input['slug'] = Str::slug($request->name, '-');
        // oude foto verwijderen
        //we kijken eerst of er een foto bestaat
        if ($request->hasFile('photo_id')) {
            $oldPhoto = $card->photo; // de huidige foto van de gebruiker
            $path = request()->file('photo_id')->store('cards');
            if ($oldPhoto) {
                unlink(public_path($oldPhoto->file));
                // $oldPhoto->delete();
                $oldPhoto->update(['file' => $path]);
                $input['photo_id'] = $oldPhoto->id;
            } else {
                $photo = Photo::create(['file' => $path]);
                $input['photo_id'] = $photo->id;
            }
        }

        $card->update($input);

        return redirect()->route('cards.index')->with([
            'alert' => [
                'message' => 'Card updated',
                'type' => 'success'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();
        return redirect()->route('cards.index')->with([
            'alert' => [
                'message' => 'Card Deleted',
                'type' => 'danger'
            ]]
        );
    }

    public function cardRestore($id)
    {
        Card::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('cards.index')->with([
            'alert' => [
                'message' => 'Card Restored',
                'type' => 'success'
            ]]);
    }
}
