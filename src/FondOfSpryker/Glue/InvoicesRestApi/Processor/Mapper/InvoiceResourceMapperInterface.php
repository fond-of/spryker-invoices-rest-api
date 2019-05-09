<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\InvoiceTransfer;
use Generated\Shared\Transfer\RestInvoicesAttributesTransfer;

interface InvoiceResourceMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestInvoicesAttributesTransfer $restInvoicesAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function mapInvoiceAttributesToInvoiceTransfer(RestInvoicesAttributesTransfer $restInvoicesAttributesTransfer): InvoiceTransfer;

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\RestInvoicesAttributesTransfer
     */
    public function mapInvoiceTransferToRestInvoicesAttributesTransfer(InvoiceTransfer $invoiceTransfer): RestInvoicesAttributesTransfer;
}
