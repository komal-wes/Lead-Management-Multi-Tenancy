<?php

namespace App\Enums;

use App\Models\Lead;

enum SourcesEnum: int {
    case Source1 = Lead::SOURCE1;
    case Source2 = Lead::SOURCE2;
    case Source3 = Lead::SOURCE3;
    case Source4 = Lead::SOURCE4;
}