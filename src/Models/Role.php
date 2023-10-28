<?php

namespace App\Models;

enum Role
{
    case User;
    case Moderator;
    case Admin;
}
