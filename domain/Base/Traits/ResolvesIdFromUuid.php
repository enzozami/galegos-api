<?php

namespace Gal\Base\Traits;

trait ResolvesIdFromUuid
{
    public static function idFromUuid(string $uuid): self
    {
        return self::where('uuid', $uuid)->firstOrFail();
    }
}
