<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\GeofenceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Geofence
 *
 * @method static Builder|Geofence newModelQuery()
 * @method static Builder|Geofence newQuery()
 * @method static Builder|Geofence query()
 * @mixin Eloquent
 * @property int $id
 * @property float $longitude
 * @property float $latitude
 * @property float $radius
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Geofence whereCreatedAt($value)
 * @method static Builder|Geofence whereId($value)
 * @method static Builder|Geofence whereLatitude($value)
 * @method static Builder|Geofence whereLongitude($value)
 * @method static Builder|Geofence whereRadius($value)
 * @method static Builder|Geofence whereUpdatedAt($value)
 * @method static create(array $array)
 * @method static GeofenceFactory factory($count = null, $state = [])
 * @mixin Eloquent
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
