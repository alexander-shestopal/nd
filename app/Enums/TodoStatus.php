<?php
namespace App\Enums;

enum TodoStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
}
