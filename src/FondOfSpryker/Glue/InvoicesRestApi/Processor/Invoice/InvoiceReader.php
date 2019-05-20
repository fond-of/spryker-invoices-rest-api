<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Processor\Invoice;

use FondOfSpryker\Glue\InvoicesRestApi\InvoicesRestApiConfig;
use FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client\InvoicesRestApiToInvoiceClientInterface;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Mapper\InvoiceResourceMapperInterface;
use Generated\Shared\Transfer\InvoiceListTransfer;
use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiValidatorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;


class InvoiceReader implements InvoiceReaderInterface
{
    /**
     * @var \Spryker\Glue\OrdersRestApi\Dependency\Client\OrdersRestApiToSalesClientInterface
     */
    protected $invoiceClient;

    /**
     * @var \FondOfSpryker\Glue\InvoicesRestApi\Processor\Mapper\InvoiceResourceMapperInterface
     */
    protected $invoiceResourceMapper;

    /**
     * @var \FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected $restApiValidator;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;


    public function __construct(
        InvoicesRestApiToInvoiceClientInterface $invoiceClient,
        InvoiceResourceMapperInterface $invoiceResourceMapper,
        RestResourceBuilderInterface $restResourceBuilder,
        RestApiErrorInterface $restApiError,
        RestApiValidatorInterface $restApiValidator
    ) {

        $this->invoiceClient = $invoiceClient;
        $this->invoiceResourceMapper = $invoiceResourceMapper;
        $this->restApiError = $restApiError;
        $this->restApiValidator = $restApiValidator;
        $this->restResourceBuilder = $restResourceBuilder;

    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     *
     * @throws
     */
    public function getInvoiceAttributes(RestRequestInterface $restRequest): RestResponseInterface
    {
        $customerReference = $this->getRequestParameter($restRequest, InvoicesRestApiConfig::QUERY_STRING_PARAMETER_CUSTOMER_REFERENCE);
        $restResponse = $this->restResourceBuilder->createRestResponse();

        return $this->findInvoiceListAttributesByCustomerReference($restRequest, $customerReference);
    }



    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addInvoices(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if ($restRequest->getResource()->getAttributes()->offsetGet(InvoicesRestApiConfig::REST_RESOURCE_ATTRIBUTE_ORDER_REFERENCE)) {
            $invoiceResponseTransfer = $this->findInvoiceByOrderReference(
                $restRequest->getResource()->getAttributes()->offsetGet(
                    InvoicesRestApiConfig::REST_RESOURCE_ATTRIBUTE_ORDER_REFERENCE
                )
            );
        }

        if (!$invoiceResponseTransfer->getHasInvoice()) {
            return $this->restApiError->addInvoiceNotFoundError($restResponse);
        }


        $restInvoiceResponseAttributesTransfer = $this
            ->invoiceResourceMapper->mapInvoiceTransferToRestInvoicesAttributesTransfer($invoiceResponseTransfer->getInvoiceTransfer());


        $restResource = $this->restResourceBuilder->createRestResource(
            InvoicesRestApiConfig::RESOURCE_INVOICES,
            $invoiceResponseTransfer->getInvoiceTransfer()->getOrderReference(),
            $restInvoiceResponseAttributesTransfer
        );

        $restResponse->addResource($restResource);

        return $restResponse;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param string $parameterName
     *
     * @return string
     */
    protected function getRequestParameter(RestRequestInterface $restRequest, string $parameterName): string
    {
        return $restRequest->getHttpRequest()->query->get($parameterName, '');
    }


    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function findInvoiceListAttributesByCustomerReference(RestRequestInterface $restRequest, string $customerReference): RestResponseInterface
    {
        $customerId = $restRequest->getUser()->getSurrogateIdentifier();
        $invoiceListTransfer = (new InvoiceListTransfer())->setCustomerReference($customerReference);


        $invoiceListTransfer = $this->invoiceClient->findInvoicesByCustomerReference($invoiceListTransfer);

        $response = $this
            ->restResourceBuilder
            ->createRestResponse();

        foreach ($invoiceListTransfer->getInvoices() as $invoiceTransfer) {
            $restInvoicesAttributesTransfer = $this->invoiceResourceMapper->mapInvoiceTransferToRestInvoicesAttributesTransfer($invoiceTransfer);

            $response = $response->addResource(
                $this->restResourceBuilder->createRestResource(
                    InvoicesRestApiConfig::RESOURCE_INVOICES,
                    $invoiceTransfer->getIdInvoice(),
                    $restInvoicesAttributesTransfer
                )
            );
        }
        
        return $response;
    }

    /**
     * @param string $orderReference
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function findInvoicesByCustomerReference(string $orderReference): InvoiceResponseTransfer
    {
        $invoiceTransfer = (new InvoiceTransfer())->setOrderReference($orderReference);

        return $this->invoiceClient->findInvoiceByOrderReference($invoiceTransfer);

    }

}
