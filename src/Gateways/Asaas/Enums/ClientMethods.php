<?php

namespace Payhub\Gateways\Asaas\Enums;

enum ClientMethods: string
{
    case ALL = 'all';
    case FIND = 'find';
    case STORE = 'store';
    case UPDATE = 'update';
    case DELETE = 'delete';
}
