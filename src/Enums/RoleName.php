<?php

namespace Machec\Contracts\Enums;

/**
 * Shared role-name enum for the three apps with a Composer dependency on
 * this package (D53) — `customer-identity`, `commercial-core`,
 * `logistics-wms`. `pim-core` deliberately never uses this enum (D53); its
 * `pim_admin` role check is a plain string literal against its own local
 * roles table (D51).
 */
enum RoleName: string
{
    case Customer = 'customer';
    case CustomerAdmin = 'customer_admin';
    case DataAdmin = 'data_admin';
    case CommercialAdmin = 'commercial_admin';
    case WmsAdmin = 'wms_admin';
}
