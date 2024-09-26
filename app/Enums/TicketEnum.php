<?php

namespace App\Enums;

enum TicketEnum: string
{
    case STATUS_OPEN = 'Open';
    case STATUS_CLOSED = 'Closed';
}