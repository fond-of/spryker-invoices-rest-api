<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Controller;

use Generated\Shared\Transfer\RestInvoiceItemsTransfer;
use Generated\Shared\Transfer\RestInvoicesAttributesTransfer;
use Generated\Shared\Transfer\RestInvoicesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \Spryker\Glue\InvoicesRestApi\InvoicesRestApiFactory getFactory()
 */
class InvoiceResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "getResourceById": {
     *          "summary": [
     *              "Retrieves invoice by OrderReference."
     *          ],
     *          "parameters": [{
     *              "name": "Accept-Language",
     *              "in": "header"
     *          }],
     *          "responseAttributesClassName": "Generated\\Shared\\Transfer\\RestInvoiceOrderDetailsAttributesTransfer",
     *          "responses": {
     *              "404": "Invoice not found."
     *          }
     *     },
     *     "getCollection": {
     *          "summary": [
     *              "Retrieves list of Invoices for a Customer."
     *          ],
     *          "parameters": [{
     *              "name": "Accept-Language",
     *              "in": "header"
     *          }]
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()->createInvoiceReader()->getInvoiceAttributes($restRequest);
    }

    /**
     * @Glue({
     *     "post": {
     *          "summary": [
     *              "Adds an invoice"
     *          ],
     *          "parameters": [{
     *              "name": "Accept-Language",
     *              "in": "header"
     *          }],
     *          "responses": {
     *              "400": "Order Reference is missing.",
     *              "404": "Order not found.",
     *              "422": "Errors appeared during item creation."
     *          }
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestInvoicesTransfer $restInvoicesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(RestRequestInterface $restRequest, RestInvoicesAttributesTransfer $restInvoicesAttributesTransfer): RestResponseInterface
    {
        return $this->getFactory()->createInvoiceWriter()->createInvoice($restInvoicesAttributesTransfer);
    }
}
