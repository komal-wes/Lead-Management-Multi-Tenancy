<?php

namespace App\Constants\Lead;

class StatusConstants
{
    const NEW  = 0;
    const OPEN  = 1;
    const CLOSED = 2;

    public static function getTypes()
    {
        return [
            self::NEW,
            self::OPEN,
            self::CLOSED
        ];
    }

    public static function getStatusType($value)
    {
        switch ($value) {
            case self::NEW:
                return 'NEW';
                case self::OPEN:
                    return 'OPEN';
            case self::CLOSED:
                return 'CLOSED';
            default:
                return null;
        }
    }

    public static function getStatuses()
    {
        $statuses = [];
        foreach (self::getTypes() as $type) {
            $statuses[$type] = self::getStatusType($type);
        }
        return $statuses;
    }
}
