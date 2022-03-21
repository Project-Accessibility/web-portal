<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Question
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionOption[] $questionOptions
 * @property-read int|null $question_options_count
 * @property int $id
 * @property int $section_id
 * @property string $title
 * @property string $question
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 */
class Question extends Model
{
    use HasFactory;

    public $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id',
        'title',
        'question',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function questionOptions(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }
}
