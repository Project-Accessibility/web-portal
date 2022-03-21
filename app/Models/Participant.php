<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Participant
 *
 * @mixin Builder
 * @property-read Collection|Answer[] $answers
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
 */
class Participant extends Model
{
    use HasFactory;

    public $table = 'participants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'questionnaire_id',
        'code',
        'finished',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'open' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function questionnaire(): object
    {
        return $this->belongsTo(Questionnaire::class)->first();
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
