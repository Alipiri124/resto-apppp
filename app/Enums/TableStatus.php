<?php

namespace App\Enums;

enum TableStatus: string
{
	case Pending='pending';
	case Avalaiable='avalaiable';
	case Unavalaiable='unavalaiable';
}