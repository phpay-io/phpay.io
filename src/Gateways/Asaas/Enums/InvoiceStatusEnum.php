<?php

namespace PHPay\Gateways\Asaas\Enums;

enum InvoiceStatusEnum: string
{
    case PENDING                      = 'PENDING';
    case RECEIVED                     = 'RECEIVED';
    case CONFIRMED                    = 'CONFIRMED';
    case OVERDUE                      = 'OVERDUE';
    case REFUNDED                     = 'REFUNDED';
    case REFUND_REQUESTED             = 'REFUNDED_REQUESTED';
    case REFUND_IN_PROGRESS           = 'REFUNDED_REQUESTED';
    case CHARGEBACK_REQUESTED         = 'REFUNDED_REQUESTED';
    case CHARGEBACK_DISPUT            = 'REFUNDED_REQUESTED';
    case AWAITING_CHARGEBACK_REVERSAL = 'REFUNDED_REQUESTED';
    case DUNNING_REQUESTED            = 'DUNING';
    case DUNNING_RECEIVED             = 'DUNING';
    case AWAITING_RISK_ANALYSIS       = 'REFUNDED_REQUESTED';
}
