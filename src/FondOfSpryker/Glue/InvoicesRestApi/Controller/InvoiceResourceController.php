<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Controller;

use Generated\Shared\Transfer\RestInvoiceItemsTransfer;
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
        return $this->getFactory()->createInvoiceReader()->getInvoices($restRequest);
    }

    /**
     * @Glue({
     *     "post": {
     *          "summary": [
     *              "Adds an item to the cart."
     *          ],
     *          "parameters": [{
     *              "name": "Accept-Language",
     *              "in": "header"
     *          }],
     *          "responses": {
     *              "400": "Cart id is missing.",
     *              "404": "Cart not found.",
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
    /*public function postAction(RestRequestInterface $restRequest, RestInvoicesTransfer $restInvoicesTransfer): RestResponseInterface
    {
        return $this->getFactory()
            ->createInvoiceReader()
            ->addItem(
                $restRequest,
                $restInvoicesTransfer
            );
    }*/

    /**
     * @Glue({
     *     "patch": {
     *          "summary": [
     *              "Updates cart item quantity."
     *          ],
     *          "parameters": [{
     *              "name": "Accept-Language",
     *              "in": "header"
     *          }],
     *          "responses": {
     *              "400": "Cart id or item id is not specified.",
     *              "404": "Cart or item not found.",
     *              "422": "Errors appeared during item update."
     *          }
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface$restRequest
     * @param \Generated\Shared\Transfer\RestCartItemsAttributesTransfer $restCartItemsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    /*public function patchAction(RestRequestInterface $restRequest, RestInvoicesItemsTransfer $restInvoicesItemTransfer): RestResponseInterface
    {
        return $this->getFactory()
            ->createInvoiceItemUpdater()
            ->updateItem(
                $restRequest,
                $restInvoicesItemTransfer
            );
    }*/

}
