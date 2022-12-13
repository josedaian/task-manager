<?php

namespace App\Traits;

trait EnumsToArray {
    static function toArray(): array {
        $onlyValues = array_map(
            fn(self $enum) => $enum->value,
            self::cases()
        );
        return array_combine(
            $onlyValues,
            $onlyValues
        );
    }

    static function toArrayWithLabel(): array {
        $onlyValues = array_map(
            fn(self $enum) => $enum->value,
            self::cases()
        );

        $onlyLabels = array_map(
            fn(self $enum) => $enum->label(),
            self::cases()
        );
        return array_combine(
            $onlyValues,
            $onlyLabels
        );
    }
}