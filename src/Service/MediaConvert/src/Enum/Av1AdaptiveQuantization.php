<?php

namespace AsyncAws\MediaConvert\Enum;

/**
 * Specify the strength of any adaptive quantization filters that you enable. The value that you choose here applies to
 * Spatial adaptive quantization (spatialAdaptiveQuantization).
 */
final class Av1AdaptiveQuantization
{
    public const HIGH = 'HIGH';
    public const HIGHER = 'HIGHER';
    public const LOW = 'LOW';
    public const MAX = 'MAX';
    public const MEDIUM = 'MEDIUM';
    public const OFF = 'OFF';

    public static function exists(string $value): bool
    {
        return isset([
            self::HIGH => true,
            self::HIGHER => true,
            self::LOW => true,
            self::MAX => true,
            self::MEDIUM => true,
            self::OFF => true,
        ][$value]);
    }
}
