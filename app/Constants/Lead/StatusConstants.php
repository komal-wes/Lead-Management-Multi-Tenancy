<?php
namespace App\Constants\Lead;

class StatusConstants
{
    const NEW  = 0;
    const OPEN  = 1;
    const CLOSED = 2;

    private static $statusLabels = [
        self::NEW => 'NEW',
        self::OPEN => 'OPEN',
        self::CLOSED => 'CLOSED',
    ];

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
        return self::$statusLabels[$value] ?? null;
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
