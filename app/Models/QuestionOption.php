<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\QuestionOption
 *
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption query()
 * @mixin Eloquent
 * @property int $id
 * @property int $question_id
 * @property string $type
 * @property string $extra_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereExtraData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereUpdatedAt($value)
 * @property-read \App\Models\Question $question
 */
class QuestionOption extends Model
{
  use HasFactory;

  public $table = 'question_options';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['question_id', 'type', 'extra_data'];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'extra_data' => AsArrayObject::class,
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];

  public function question(): BelongsTo
  {
    return $this->belongsTo(Question::class);
  }

  public function answers(): HasMany
  {
    return $this->hasMany(Answer::class)->first();
  }
}
