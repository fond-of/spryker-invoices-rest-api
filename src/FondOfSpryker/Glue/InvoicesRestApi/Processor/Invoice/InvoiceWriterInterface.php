<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Processor\Invoice;

use Generated\Shared\Transfer\RestInvoicesAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface InvoiceWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestInvoicesAttributesTransfer $restInvoicesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createInvoice(RestInvoicesAttributesTransfer $restInvoicesAttributesTransfer): RestResponseInterface;
}
