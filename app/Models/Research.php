<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Research
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Research newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Research newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Research query()
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Research whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Research whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Research whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Research whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Research whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Participant[] $participants
 * @property-read int|null $participants_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Questionnaire[] $questionnaires
 * @property-read int|null $questionnaires_count
 */
class Research extends Model
{
    use HasFactory;

    public $table = 'researches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

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
