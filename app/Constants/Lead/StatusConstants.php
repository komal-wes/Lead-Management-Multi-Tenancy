<?php
namespace App\Constants\Lead;

enum StatusConstants: int {
    case NEW = 0;
    case OPEN = 1;
    case CLOSED = 2;
}