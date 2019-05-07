<?php

namespace Spryker\Glue\InvoiceRestApi\Processor\Invoice;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface InvoiceReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getInvoices(RestRequestInterface $restRequest): RestResponseInterface;

    /**
     * @param string $orderReference
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|null
     */
    public function findOrderInvoice(string $orderReference): ?RestResourceInterface;

    /**
     * @param string $orderReference
     * @param string $customerReference
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|null
     */
    public function findCustomerInvoices(string $orderReference,  string $customerReference): ?RestResourceInterface;
}
