<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation;

use FondOfSpryker\Glue\InvoicesRestApi\InvoicesRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
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

}
