<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;

class Answer extends Model
{
    use HasFactory;
    protected $primaryKey = ["response_id", "question_id"];
    protected $fillable = ['answer_key'];

    // protected $casts = [
    //     "answer_key" => "int",
    // ];

    public $incrementing = false;

    function response(){
        return $this->belongsTo(Response::class);
    }

    function question(){
        return $this->belongsTo(Question::class);
    }

    // public function scopeByCompositeKey($query, $response_id, $question_id){
    //     return $query->where('response_id', $response_id)
    //         ->where('question_id', $question_id);
    // }


    // protected function setKeysForSaveQuery(Illuminate\Database\Eloquent\Builder $query)
    // {
    //     $query
    //         ->where('response_id', '=', $this->getAttribute('response_id'))
    //         ->where('question_id', '=', $this->getAttribute('question_id'));

    //     return $query;
    // }

    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }
        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }
        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }
        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }
        return $this->getAttribute($keyName);
    }
}
