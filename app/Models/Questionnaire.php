<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class Questionnaire extends Model
{
    use HasFactory;

    public $table = 'questionnaires';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'research_id',
        'title',
        'description',
        'instructions',
        'open',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'open' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function research(): object
    {
        return $this->belongsTo(Research::class)->first();
    }
}
