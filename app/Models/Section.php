<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * App\Models\Section
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @mixin Eloquent
 * @property int $id
 * @property int $questionnaire_id
 * @property int|null $geofence_id
 * @property string $title
 * @property string|null $description
 * @property string|null $location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereGeofenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereQuestionnaireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedAt($value)
 * @property-read int|null $questions_count
 * @property-read \App\Models\Geofence|null $geofence
 * @property-read \App\Models\Questionnaire $questionnaire
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

    public function geofence(): HasOne
    {
        return $this->hasOne(Geofence::class);
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
