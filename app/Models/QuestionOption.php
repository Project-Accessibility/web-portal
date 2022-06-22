<?php

namespace App\Models;

use App\Enums\QuestionOptionType;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\QuestionOption
 *
 * @method static Builder|QuestionOption newModelQuery()
 * @method static Builder|QuestionOption newQuery()
 * @method static Builder|QuestionOption query()
 * @mixin Eloquent
 * @property int $id
 * @property int $question_id
 * @property string $type
 * @property string $extra_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|QuestionOption whereCreatedAt($value)
 * @method static Builder|QuestionOption whereExtraData($value)
 * @method static Builder|QuestionOption whereId($value)
 * @method static Builder|QuestionOption whereQuestionId($value)
 * @method static Builder|QuestionOption whereType($value)
 * @method static Builder|QuestionOption whereUpdatedAt($value)
 * @property-read \App\Models\Question $question
 */
class QuestionOption extends Model
{
    use HasFactory;

    /* @var string */
    public $table = 'question_options';

    /* @var array */
    protected $fillable = ['question_id', 'type', 'order', 'extra_data'];

    /* @var array */
    protected $casts = [
        'type' => QuestionOptionType::class,
        'extra_data' => AsArrayObject::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answers(): HasMany
    {
        return $this->HasMany(Answer::class);
    }
}
