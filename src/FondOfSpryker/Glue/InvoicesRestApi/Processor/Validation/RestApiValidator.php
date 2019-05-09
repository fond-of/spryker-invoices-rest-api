<?php


namespace FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation;

use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestApiValidator implements RestApiValidatorInterface
{
    /**
     * @var \FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiErrorInterface|\Spryker\Glue\InvoicesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $apiErrors;

    /**
     * RestApiValidator constructor.
     *
     * @param \FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiErrorInterface $apiErrors
     */
    public function __construct(RestApiErrorInterface $apiErrors)
    {
        $this->apiErrors = $apiErrors;
    }

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
    ): RestResponseInterface {
        if (!$invoiceResponseTransfer->getHasInvoice()) {
            return $this->apiErrors->addInvoiceNotFoundError($restResponse);
        }

        return $restResponse;
    }



}
