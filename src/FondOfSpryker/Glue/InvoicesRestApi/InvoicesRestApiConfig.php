<?php

namespace FondOfSpryker\Glue\InvoicesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class InvoicesRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_INVOICES = 'invoices';
    public const RESOURCE_INVOICE_ITEMS = 'items';

    public const CONTROLLER_INVOICES = 'invoice-resource';
    public const CONTROLLER_INVOICE_ITEMS = 'invoice-items-resource';

    public const ACTION_INVOICES_GET = 'get';
    public const ACTION_INVOICES_POST = 'post';

    public const ACTION_INVOICE_ITEMS_POST = 'post';
    public const ACTION_INVOICE_ITEMS_PATCH = 'patch';

    public const RESPONSE_CODE_ITEM_VALIDATION = '102';
    public const RESPONSE_CODE_ITEM_NOT_FOUND = '103';
    public const RESPONSE_CODE_INVOICE_ID_MISSING = '104';
    public const RESPONSE_CODE_FAILED_CREATING_INVOICE = '107';

    public const EXCEPTION_MESSAGE_INVOICE_ID_MISSING = 'Invoice uuid is missing.';
    public const EXCEPTION_MESSAGE_FAILED_TO_CREATE_INVOICE = 'Failed to create invoice.';
    public const EXCEPTION_MESSAGE_INVOICE_WITH_ID_NOT_FOUND = 'Invoice with given uuid not found.';
    
    public const REST_RESOURCE_ATTRIBUTE_ORDER_REFERENCE = "orderReference";
    public const REST_RESOURCE_ATTRIBUTE_CUSTOMER_REFERENCE = "customerReference";

    public const RESPONSE_CODE_INVOICE_NOT_FOUND = '101';
    public const RESPONSE_DETAILS_INVOICE_NOT_FOUND = 'Invoice not found.';
    public const RESPONSE_MESSAGE_INVOICE_CANT_CREATE_INVOICE = 'Invoice can not be created';

    public const QUERY_STRING_PARAMETER_CUSTOMER_REFERENCE = 'customer_reference';




    
}
