<?php

namespace Gal\Base\Traits;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait ResolvesIdFromUuid
{
    public static function idFromUuid(string $uuid): int
    {
        return static::where('uuid', $uuid)->valueOrFail('id');
    }
}
