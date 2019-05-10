<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation;

use FondOfSpryker\Glue\InvoicesRestApi\InvoicesRestApiConfig;
use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use mysql_xdevapi\Exception;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestApiError implements RestApiErrorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addInvoiceNotFoundError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(InvoicesRestApiConfig::RESPONSE_CODE_INVOICE_NOT_FOUND)
            ->setStatus(Response::HTTP_NOT_FOUND)
            ->setDetail(InvoicesRestApiConfig::RESPONSE_DETAILS_INVOICE_NOT_FOUND);

        return $restResponse->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     * @param \Generated\Shared\Transfer\InvoiceResponseTransfer $invoiceResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function processInvoiceErrorOnCreate(RestResponseInterface $restResponse, InvoiceResponseTransfer $invoiceResponseTransfer): RestResponseInterface
    {
        return $this->addInvoiceCantCreateMessageError(
            $restResponse,
            InvoicesRestApiConfig::RESPONSE_MESSAGE_INVOICE_CANT_CREATE_INVOICE
        );
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     * @param string $errorMessage
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addInvoiceCantCreateMessageError(RestResponseInterface $restResponse, string $errorMessage): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(InvoicesRestApiConfig::RESPONSE_MESSAGE_INVOICE_CANT_CREATE_INVOICE)
            ->setStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->setDetail($errorMessage);

        return $restResponse->addError($restErrorMessageTransfer);
    }

}
