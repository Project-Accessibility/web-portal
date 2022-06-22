<?php

namespace App\Models;

use App\Traits\RelationsManager;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Questionnaire
 *
 * @method static Builder|Questionnaire newModelQuery()
 * @method static Builder|Questionnaire newQuery()
 * @method static Builder|Questionnaire query()
 * @mixin Eloquent
 * @property int $id
 * @property int $research_id
 * @property string $title
 * @property string|null $description
 * @property string|null $instructions
 * @property int $open
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Questionnaire whereCreatedAt($value)
 * @method static Builder|Questionnaire whereDescription($value)
 * @method static Builder|Questionnaire whereId($value)
 * @method static Builder|Questionnaire whereInstructions($value)
 * @method static Builder|Questionnaire whereOpen($value)
 * @method static Builder|Questionnaire whereResearchId($value)
 * @method static Builder|Questionnaire whereTitle($value)
 * @method static Builder|Questionnaire whereUpdatedAt($value)
 * @property-read \App\Models\Research $research
 */
class Questionnaire extends Model
{
    use HasFactory, RelationsManager;

    /* @var string */
    public $table = 'questionnaires';

    /* @var array */
    protected $fillable = [
        'research_id',
        'title',
        'description',
        'instructions',
        'help',
        'open',
    ];

    /* @var array */
    protected $casts = [
        'open' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function research(): BelongsTo
    {
        return $this->belongsTo(Research::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function results(): Collection
    {
        $sections = $this->sections()->get();
        return $sections->filter(function ($section) {
            $questions = $section->getLatestVersionsOfQuestions();
            $questions = $questions->filter(function ($question) {
                $answers = $question->answers();
                $question['answers'] = $answers->toArray();
                return $question;
            });
            $section['questions'] = $questions;
            return $section;
        });
    }
}
