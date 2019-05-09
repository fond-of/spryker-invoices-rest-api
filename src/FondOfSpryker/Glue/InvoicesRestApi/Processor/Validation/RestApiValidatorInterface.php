<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation;

use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RestApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceResponseTransfer $invoiceResponseTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function validateInvoiceResponseTransfer(
        InvoiceResponseTransfer $invoiceResponseTransfer,
        RestRequestInterface $restRequest,
        RestResponseInterface $restResponse
    ): RestResponseInterface;

}
