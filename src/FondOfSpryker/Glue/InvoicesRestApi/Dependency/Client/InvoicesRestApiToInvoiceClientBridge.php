<?php

namespace FondOfSpyker\Glue\InvoicesRestApi\Dependency\Client;

use FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client\InvoicesRestApiToInvoiceClientInterface;


class InvoicesRestApiToInvoiceClientBridge implements InvoicesRestApiToInvoiceClientInterface
{
    /**
     * @var \FondOfSpryker\Client\Innvoice\InvoiceClientInterface
     */
    protected $invoiceClient;

    /**
     * @param \FondOfSpryker\Client\Invoice\InvoiceClientInterface $invoiceClient
     */
    public function __construct($invoiceClient)
    {
        $this->invoiceClient = $invoiceClient;
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function addInvoice(InvoiceTransfer $invoiceTransfer): InvoiceResponseTransfer
    {
        return $this->invoiceClient->($invoiceTransfer);
    }
}
