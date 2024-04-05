<?php

namespace App\Constants\Lead;

class SourceConstants
{
    const Source1  = 0;
    const Source2 = 1;
    const Source3 = 2;
    const Source4 = 3;


    private static $sourceLabels = [
        self::Source1 => 'Source1',
        self::Source2 => 'Source2',
        self::Source3 => 'Source3',
        self::Source4 => 'Source4',
    ];

    public static function getTypes()
    {
        return [
            self::Source1,
            self::Source2,
            self::Source3,
            self::Source4,
        ];
    }

    public static function getSourceType($value)
    {
        return self::$sourceLabels[$value] ?? null;
    }

    public static function getSources()
    {
        $sources = [];
        foreach (self::getTypes() as $type) {
            $sources[$type] = self::getSourceType($type);
        }
        return $sources;
    }
}
