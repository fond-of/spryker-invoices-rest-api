<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client;

use Generated\Shared\Transfer\InvoiceListTransfer;
use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;


class InvoicesRestApiToInvoiceClientBridge implements InvoicesRestApiToInvoiceClientInterface
{
    /**
     * @var \FondOfSpryker\Client\Invoice\InvoiceClientInterface
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
    public function findInvoicesByCustomerReference(InvoiceListTransfer $invoiceListTransfer): InvoiceListTransfer
    {
        return $this->invoiceClient->findInvoicesByCustomerReference($invoiceListTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function createInvoice(InvoiceTransfer $invoiceTransfer): InvoiceResponseTransfer
    {
        return $this->invoiceClient->createInvoice($invoiceTransfer);
    }

}
