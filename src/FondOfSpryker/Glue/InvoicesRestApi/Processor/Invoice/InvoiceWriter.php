<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Processor\Invoice;

use FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client\InvoicesRestApiToInvoiceClientInterface;
use FondOfSpryker\Glue\InvoicesRestApi\InvoicesRestApiConfig;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Mapper\InvoiceResourceMapperInterface;
use Generated\Shared\Transfer\InvoiceTransfer;
use Generated\Shared\Transfer\RestCustomersAttributesTransfer;
use Generated\Shared\Transfer\RestInvoicesAttributesTransfer;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiValidatorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class InvoiceWriter implements InvoiceWriterInterface
{
    /**
     * @var \FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client\InvoicesRestApiToInvoiceClientInterface
     */
    protected $invoiceClient;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

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
     * @var \Spryker\Glue\CustomersRestApi\Processor\Customer\CustomerReaderInterface
     */
    protected $invoiceReader;

    /**
     * @var \Spryker\Glue\InvoicesRestApiExtension\Dependency\Plugin\InvoicesPostRegisterPluginInterface[]
     */
    protected $invoicePostRegisterPlugins;

    /**
     * InvoiceWriter constructor.
     *
     * @param \FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client\InvoicesRestApiToInvoiceClientInterface $invoiceClient
     * @param \FondOfSpryker\Glue\InvoicesRestApi\Processor\Invoice\InvoiceReaderInterface $invoiceReader
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\InvoicesRestApi\Processor\Mapper\InvoiceResourceMapperInterface $invoiceResourceMapper
     * @param \Spryker\Glue\CustomersRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \Spryker\Glue\CustomersRestApi\Processor\Validation\RestApiValidatorInterface $restApiValidator
     * @param array $invoicePostRegisterPlugins
     */
    public function __construct(
        InvoicesRestApiToInvoiceClientInterface $invoiceClient,
        InvoiceReaderInterface $invoiceReader,
        RestResourceBuilderInterface $restResourceBuilder,
        InvoiceResourceMapperInterface $invoiceResourceMapper,
        RestApiErrorInterface $restApiError,
        RestApiValidatorInterface $restApiValidator,
        array $invoicePostRegisterPlugins
    ) {
        $this->invoiceClient = $invoiceClient;
        $this->invoiceReader = $invoiceReader;
        $this->restResourceBuilder = $restResourceBuilder;
        $this->invoiceResourceMapper = $invoiceResourceMapper;
        $this->restApiError = $restApiError;
        $this->restApiValidator = $restApiValidator;
        $this->invoicePostRegisterPlugins = $invoicePostRegisterPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\RestInvoicesAttributesTransfer $restInvoicesAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createInvoice(RestInvoicesAttributesTransfer $restInvoicesAttributesTransfer): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $invoiceTransfer = (new InvoiceTransfer())->fromArray($restInvoicesAttributesTransfer->toArray(), true);
        $invoiceResponseTransfer = $this->invoiceClient->createInvoice($invoiceTransfer);


        if (!$invoiceResponseTransfer->getIsSuccess()) {
            return $this->restApiError->processInvoiceErrorOnCreate(
                $restResponse,
                $invoiceResponseTransfer
            );
        }

        $restResource = $this->restResourceBuilder->createRestResource(
            InvoicesRestApiConfig::RESOURCE_INVOICES,
            $invoiceResponseTransfer->getInvoiceTransfer()->getOrderReference(),
            $restInvoicesAttributesTransfer
        );

        return $restResponse->addResource($restResource);
    }



    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    protected function executeInvoicePostCreatePlugins(InvoiceTransfer $invoiceTransfer): InvoiceTransfer
    {
        foreach ($this->invoicePostCreatePlugins as $invoicePostCreatePlugin) {
            $customerTransfer = $invoicePostCreatePlugin->postCreate($invoiceTransfer);
        }

        return $invoiceTransfer;
    }
}
