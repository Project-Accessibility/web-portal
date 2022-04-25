<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Answer
 *
 * @method static Builder|Answer newModelQuery()
 * @method static Builder|Answer newQuery()
 * @method static Builder|Answer query()
 * @mixin Eloquent
 * @property int $id
 * @property int $participant_id
 * @property int $question_option_id
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Answer whereAnswer($value)
 * @method static Builder|Answer whereCreatedAt($value)
 * @method static Builder|Answer whereId($value)
 * @method static Builder|Answer whereParticipantId($value)
 * @method static Builder|Answer whereQuestionOptionId($value)
 * @method static Builder|Answer whereUpdatedAt($value)
 * @method static where(string $string, string $string1, int $id)
 * @property-read \App\Models\Participant $participant
 * @property-read \App\Models\QuestionOption $questionOption
 */
class Answer extends Model
{
    use HasFactory;

    /* @var string */
    public $table = 'answers';

    /* @var array */
    protected $fillable = ['participant_id', 'question_option_id', 'answer'];

    /* @var array */
    protected $casts = [
        'answer' => AsArrayObject::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function option(): QuestionOption
    {
        return QuestionOption::whereId($this->question_option_id)->first();
    }
}
