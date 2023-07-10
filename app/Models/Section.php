<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\SectionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Section
 *
 * @method static Builder|Section newModelQuery()
 * @method static Builder|Section newQuery()
 * @method static Builder|Section query()
 * @mixin Eloquent
 * @property int $id
 * @property int $questionnaire_id
 * @property int|null $geofence_id
 * @property string $title
 * @property string|null $description
 * @property string|null $location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Section whereCreatedAt($value)
 * @method static Builder|Section whereDescription($value)
 * @method static Builder|Section whereGeofenceId($value)
 * @method static Builder|Section whereId($value)
 * @method static Builder|Section whereLocation($value)
 * @method static Builder|Section whereQuestionnaireId($value)
 * @method static Builder|Section whereTitle($value)
 * @method static Builder|Section whereUpdatedAt($value)
 * @property-read int|null $questions_count
 * @property-read \App\Models\Geofence|null $geofence
 * @property-read \App\Models\Questionnaire $questionnaire
 * @property string|null $location_description
 * @property-read Collection<int, \App\Models\Question> $questions
 * @method static SectionFactory factory($count = null, $state = [])
 * @method static Builder|Section whereLocationDescription($value)
 * @mixin Eloquent
 */
class Section extends Model
{
    use HasFactory;

    /* @var string */
    public $table = 'sections';

    /* @var array */
    protected $fillable = [
        'questionnaire_id',
        'geofence_id',
        'title',
        'description',
        'location_description',
    ];

    /* @var array */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function questionnaire(): BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function geofence(): BelongsTo
    {
        return $this->belongsTo(Geofence::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function getLatestVersionsOfQuestions(): Collection
    {
        return $this->questions()
            ->orderBy('version', 'desc')
            ->get()
            ->unique('uuid');
    }
}
