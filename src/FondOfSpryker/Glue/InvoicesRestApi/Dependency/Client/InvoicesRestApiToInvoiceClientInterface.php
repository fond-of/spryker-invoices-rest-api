<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client;

use Generated\Shared\Transfer\InvoiceTransfer;

interface InvoicesRestApiToInvoiceClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     * @param array $params
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function addInvoice(InvoiceTransfer $invoiceTransfer);
}
