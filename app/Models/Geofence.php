<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Geofence
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Geofence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Geofence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Geofence query()
 * @mixin Eloquent
 * @property int $id
 * @property float $longitude
 * @property float $latitude
 * @property float $radius
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Geofence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geofence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geofence whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geofence whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geofence whereRadius($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Geofence whereUpdatedAt($value)
 * @method static create(array $array)
 */
class Geofence extends Model
{
    use HasFactory;

    /* @var string */
    public $table = 'geofences';

    /* @var array */
    protected $fillable = ['longitude', 'latitude', 'radius'];

    /* @var array */
    protected $casts = [
        'longitude' => 'float',
        'latitude' => 'float',
        'radius' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
