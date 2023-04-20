<?php

namespace App\Enums;

enum Permission: string
{
    case CREATE_USER = 'Create user';
    case EDIT_USER = 'Edit user';
    case DELETE_USER = 'Delete user';
    case VIEW_USER = 'View user';

    case CREATE_CLIENT = 'Додади комитент';
    case EDIT_CLIENT = 'Измени комитент';
    case DELETE_CLIENT = 'Бриши комитент';
    case VIEW_CLIENT = 'Види комитент';
}
