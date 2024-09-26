<?php

namespace App\Enums;

enum GlobalEnum: string
{
    case UNKNOWN = 'Unknown';

    case NA = 'N/A';

    case STATUS_ACTIVE = 'Active';
    case STATUS_IN_ACTIVE = 'Inactive';
}