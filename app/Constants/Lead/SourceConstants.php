<?php

namespace App\Constants\Lead;

class SourceConstants
{
    const Source1  = 0;
    const Source2 = 1;
    const Source3 = 2;
    const Source4 = 3;

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
        switch ($value) {
            case self::Source1:
                return 'Source1';
            case self::Source2:
                return 'Source2';
            case self::Source3:
                return 'Source3';
            case self::Source4:
                return 'Source4';
            default:
                return null;
        }
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
