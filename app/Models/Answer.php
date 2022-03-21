<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Answer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer query()
 * @mixin Eloquent
 * @property int $id
 * @property int $participant_id
 * @property int $question_option_id
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereQuestionOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereUpdatedAt($value)
 */
class Answer extends Model
{
    use HasFactory;

    public $table = 'answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'participant_id',
        'question_option_id',
        'answer',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'answer' => AsArrayObject::class,
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function participant(): object
    {
        return $this->belongsTo(Participant::class)->first();
    }

    public function questionOption(): object
    {
        return $this->belongsTo(QuestionOption::class)->first();
    }
}
