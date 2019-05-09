<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client;

use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

interface InvoicesRestApiToInvoiceClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function findInvoiceByOrderReference(InvoiceTransfer $invoiceTransfer): InvoiceResponseTransfer;

}
