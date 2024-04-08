<?php
namespace App\Enums;

use App\Models\Lead;

enum StatusesEnum: int {
    case NEW = Lead::STATUS_NEW;
    case OPEN = Lead::STATUS_OPEN;
    case CLOSED = Lead::STATUS_CLOSED;
}