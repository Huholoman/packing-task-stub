<?php

namespace App\Infrastructure\Http\Endpoints\Factories;

use App\DomainModel\Packaging\PackagingCalculator\VOs\Request;
use App\DomainModel\Packaging\PackagingCalculator\VOs\Request\Box;
use App\Infrastructure\Http\Endpoints\Factories\Exceptions\InvalidPropertyTypeException;
use App\Infrastructure\Http\Endpoints\Factories\Exceptions\MissingProductsException;
use App\Infrastructure\Http\Endpoints\Factories\Exceptions\MissingPropertyException;
use Psr\Http\Message\StreamInterface;

final class PackagingCalculatorRequestFactory
{
    private const KEY_ID = 'id';

    private const KEY_WIDTH = 'width';

    private const KEY_HEIGHT = 'height';

    private const KEY_LENGTH = 'length';

    private const KEY_WEIGHT = 'weight';

    public function create(StreamInterface $stream): Request {
        $strPayload = stream_get_contents($stream);
        $payload = \json_decode($strPayload, true);

        if (!\array_key_exists('products', $payload)) {
            throw new MissingProductsException();
        }

        return new Request($this->parseBoxes($payload));
    }

    /**
     * @param list<array<string, float|int>> $boxes
     *
     * @return Box
     */
    private function parseBoxes(array $boxes): array {
        return array_map($this->parseBox, $boxes);
    }

    /**
     * @param array<string, float|int> $box
     *
     * @throws InvalidPropertyTypeException|MissingPropertyException
     */
    private function parseBox(array $box): Box {
        $requiredKeys = [self::KEY_ID, self::KEY_WIDTH, self::KEY_HEIGHT, self::KEY_LENGTH, self::KEY_WEIGHT];
        foreach ($requiredKeys as $requiredKey) {
            if (\array_key_exists($requiredKey, $box)) {
                throw new MissingPropertyException($requiredKey);
            }
        }

        return Box::fromValues(
            $this->getInt($box, self::KEY_ID),
            $this->getFloat($box, self::KEY_WIDTH),
            $this->getFloat($box, self::KEY_HEIGHT),
            $this->getFloat($box, self::KEY_LENGTH),
            $this->getFloat($box, self::KEY_WEIGHT),
        );
    }

    /**
     * @param array<string, int|float> $box
     *
     * @throws InvalidPropertyTypeException
     */
    private function getInt(array $box, string $key): int {
        $strVal = $box[$key];
        if (!\is_int($strVal)) {
            throw InvalidPropertyTypeException::expectedInt($key, $strVal);
        }

        return (int) $strVal;
    }

    /**
     * @param array<string, int|float> $box
     *
     * @throws InvalidPropertyTypeException
     */
    private function getFloat(array $box, string $key): float {
        $strVal = $box[$key];
        if (!\is_float($strVal)) {
            throw InvalidPropertyTypeException::expectedFloat($key, $strVal);
        }

        return (float) $strVal;
    }
}
