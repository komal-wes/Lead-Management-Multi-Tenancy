<?php
namespace App\Enums;
enum StatusesEnum: int {
    case NEW = 0;
    case OPEN = 1;
    case CLOSED = 2;
}