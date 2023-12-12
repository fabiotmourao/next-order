<?php

namespace App\Helpers;


class CustomFuncs
{
    public static function translateOrderStatus($orderStatus) {
        switch ($orderStatus) {
            case 'CANCELLED':
                return 'Cancelado';
            case 'PLACED':
                return 'Realizado';
            case 'CONCLUDED':
                return 'Concluído';
            case 'CONFIRMED':
                return 'Confirmado';
            default:
                return $orderStatus;
        }
    }

    public static function getOrderStatusColor($orderStatus) {
        switch ($orderStatus) {
            case 'CANCELLED':
                return 'danger';
            case 'PLACED':
                return 'success';
            case 'CONCLUDED':
                return 'success';
            case 'CONFIRMED':
                return 'primary';
            default:
                return 'dark';
        }
    }
}
