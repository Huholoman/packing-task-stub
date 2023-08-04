<?php

namespace App\Infrastructure\Http\Endpoints\Factories;

use App\DomainModel\Packaging;

class PackagingResponseFactory
{
    const KEY_PACKAGING = 'packaging';

    const KEY_WIDTH = 'width';

    const KEY_HEIGHT = 'height';

    const KEY_LENGTH = 'length';

    /**
     * @return array<string, int|double>
     */
    public function create(Packaging $packaging): array {
        return [
            self::KEY_PACKAGING => [
                self::KEY_WIDTH => $packaging->width,
                self::KEY_HEIGHT => $packaging->height,
                self::KEY_LENGTH => $packaging->length,
            ],
        ];
    }
}
