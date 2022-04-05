<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use ReflectionClass;
use ReflectionMethod;

trait RelationsManager
{
    protected static array $relationsList = [];

    protected static bool $relationsInitialized = false;

    protected static array $relationClasses = [
        HasOne::class,
        HasMany::class,
        BelongsTo::class,
        BelongsToMany::class,
    ];

    public static function getAllRelations($type = null): array
    {
        if (!self::$relationsInitialized) {
            self::initAllRelations();
        }

        return $type ? self::$relationsList[$type] ?? [] : self::$relationsList;
    }

    protected static function initAllRelations()
    {
        self::$relationsInitialized = true;

        $reflect = new ReflectionClass(static::class);

        foreach ($reflect->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            /** @var ReflectionMethod $method */
            if (
                $method->hasReturnType() &&
                in_array(
                    (string) $method->getReturnType(),
                    self::$relationClasses,
                )
            ) {
                self::$relationsList[
                    (string) $method->getReturnType()
                ][] = $method->getName();
            }
        }
    }

    public static function withAll(): Builder
    {
        $relations = array_merge(...array_values(static::getAllRelations()));

        return $relations ? self::with($relations) : self::query();
    }
}
