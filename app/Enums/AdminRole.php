<?php

namespace App\Enums;

enum AdminRole: string
{
    case SuperAdmin = 'active';
    case Admin = 'admin';
    case CustomerRep = 'customer_rep';  
    case ProductManager = 'product_manager';
    case WarehouseManager = 'warehouse_manager';
    case OrderManager = 'order_manager';
    case MarketingManager = 'marketing_manager';
    case FinanceManager = 'finance_manager';
    case ShippingManager = 'shipping_manager';
    case ContentManager = 'content_manager';
    case AffiliateManager = 'affiliate_manager';
    case User = 'user';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
