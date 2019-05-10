<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation;

use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestApiErrorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addInvoiceNotFoundError(RestResponseInterface $restResponse): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     * @param \Generated\Shared\Transfer\InvoiceResponseTransfer $invoiceResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function processInvoiceErrorOnCreate(RestResponseInterface $restResponse, InvoiceResponseTransfer $invoiceResponseTransfer): RestResponseInterface;

}
