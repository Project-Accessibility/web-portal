<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * App\Models\Question
 *
 * @method static Builder|Question newModelQuery()
 * @method static Builder|Question newQuery()
 * @method static Builder|Question query()
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionOption[] $questionOptions
 * @property-read int|null $question_options_count
 * @property int $id
 * @property int $section_id
 * @property string $title
 * @property string $question
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Question whereCreatedAt($value)
 * @method static Builder|Question whereId($value)
 * @method static Builder|Question whereUuid($value)
 * @method static Builder|Question whereQuestion($value)
 * @method static Builder|Question whereSectionId($value)
 * @method static Builder|Question whereTitle($value)
 * @method static Builder|Question whereUpdatedAt($value)
 * @property-read \App\Models\Section $section
 */
class Question extends Model
{
    use HasFactory;

    /* @var string */
    public $table = 'questions';

    /* @var array */
    protected $fillable = [
        'section_id',
        'uuid',
        'version',
        'title',
        'question',
    ];

    /* @var array */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($question) {
            if (!$question->uuid) {
                $question->uuid = Str::uuid();
                $question->version = 1;
            } else {
                $currentQuestion = Question::whereUuid($question->uuid)
                    ->orderBy('version', 'desc')
                    ->first();
                $question->version = $currentQuestion->version + 1;
            }
        });
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class)->orderBy('order', 'ASC');
    }

    public function answers(): Collection
    {
        $answers = collect();
        $questions = Question::whereUuid($this->uuid)
            ->with('options.answers')
            ->get();
        foreach ($questions as $question) {
            foreach ($question->options as $option) {
                foreach ($option->answers as $answer) {
                    $answerExists =
                        $answers
                            ->where(
                                'participant_id',
                                '=',
                                $answer->participant_id,
                            )
                            ->first() != null;
                    if (!$answerExists) {
                        $code = $answer->participant->code;
                        $answer['question_id'] = $question->id;
                        $answer['participant_code'] = $code;
                        $answers->push($answer);
                    }
                }
            }
        }
        return $answers;
    }

    public function getLatestAnswerOfParticipant(int $participantId): ?string
    {
        return $this->options
            ->sortByDesc(function (QuestionOption $option) use (
                $participantId,
            ) {
                return $option
                    ->answers()
                    ->where('participant_id', $participantId)
                    ->max('updated_at');
            })
            ->first()
            ->answers()
            ->where('participant_id', $participantId)
            ->first()->updated_at;
    }

    public function latestVersion()
    {
        return Question::whereUuid($this->uuid)->max('version');
    }
}
