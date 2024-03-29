<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\ResearchFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Research
 *
 * @method static Builder|Research newModelQuery()
 * @method static Builder|Research newQuery()
 * @method static Builder|Research query()
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Research whereCreatedAt($value)
 * @method static Builder|Research whereDescription($value)
 * @method static Builder|Research whereId($value)
 * @method static Builder|Research whereTitle($value)
 * @method static Builder|Research whereUpdatedAt($value)
 * @method static create(array $array)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Participant[] $participants
 * @property-read int|null $participants_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Questionnaire[] $questionnaires
 * @property-read int|null $questionnaires_count
 * @method static ResearchFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
class Research extends Model
{
    use HasFactory;

    /* @var string */
    public $table = 'researches';

    /* @var array */
    protected $fillable = ['title', 'description'];

    /* @var array */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function questionnaires(): HasMany
    {
        return $this->hasMany(Questionnaire::class);
    }
}
