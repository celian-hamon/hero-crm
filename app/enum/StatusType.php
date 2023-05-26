<?php

namespace App\enum;

enum StatusType: string
{
    use EnumToArray;

    case Pending = 'pending';
    case Cancelled = 'cancelled';
    case Accepted = 'accepted';
    case InProgress = 'in progress';
    case Done = 'done';
}
