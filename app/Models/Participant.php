<?php

namespace App\Models;

use App\Casts\DisplayDateTime;
use Carbon\Carbon;
use DateTime;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Participant
 *
 * @mixin Builder
 * @property-read int|null $answers_count
 * @method static Builder|Participant newModelQuery()
 * @method static Builder|Participant newQuery()
 * @method static Builder|Participant query()
 * @method static Builder|Participant whereId($value)
 * @property int $id
 * @property int $questionnaire_id
 * @property string $code
 * @property int $finished
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Participant whereCode($value)
 * @method static Builder|Participant whereCreatedAt($value)
 * @method static Builder|Participant whereFinished($value)
 * @method static Builder|Participant whereQuestionnaireId($value)
 * @method static Builder|Participant whereUpdatedAt($value)
 * @property-read \App\Models\Questionnaire $questionnaire
 */
class Participant extends Model
{
    use HasFactory;

    /* @var string */
    public $table = 'participants';

    /* @var array */
    protected $fillable = ['questionnaire_id', 'code', 'finished'];

    /* @var array */
    protected $casts = [
        'finished' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function questionnaire(): BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function lastUpdated()
    {
        $lastAnswer = $this->answers()->max('updated_at');
        $lastUpdate = $this->updated_at;

        if ($lastAnswer > $lastUpdate) {
            return $lastAnswer;
        } else {
            return $lastUpdate;
        }
    }
}
