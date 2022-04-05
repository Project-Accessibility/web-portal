<?php

namespace App\Models;

use App\Traits\RelationsManager;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Questionnaire
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire query()
 * @mixin Eloquent
 * @property int $id
 * @property int $research_id
 * @property string $title
 * @property string|null $description
 * @property string|null $instructions
 * @property int $open
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereResearchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire whereUpdatedAt($value)
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
        'open',
        'teachable_machine_link',
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
}
