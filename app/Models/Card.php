<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory;
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','slug','monster_attribute_id','level','photo_id','monster_type_id','monster_class_id','pendulum','monster_special_type_id','description','atk','def','spell_type_id','trap_type_id','price','card_type_id'];

    public function monsterAttribute(){
        return $this->belongsTo(MonsterAttribute::class);
    }

    public function photo(){
        return $this->belongsTo(Photo::class);
    }

    public function monsterType(){
        return $this->belongsTo(MonsterType::class);
    }

    public function monsterClass(){
        return $this->belongsTo(MonsterClass::class);
    }

    public function monsterSpecialType(){
        return $this->belongsTo(MonsterSpecialType::class);
    }

    public function spellType(){
        return $this->belongsTo(SpellType::class);
    }

    public function trapType(){
        return $this->belongsTo(TrapType::class);
    }
    public function cardType(){
        return $this->belongsTo(CardType::class);
    }
}
