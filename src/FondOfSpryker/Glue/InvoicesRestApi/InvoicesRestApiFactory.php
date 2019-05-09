<?php

namespace FondOfSpryker\Glue\InvoicesRestApi;

use FondOfSpryker\Glue\InvoicesRestApi\Processor\Invoice\InvoiceReader;
use FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client\InvoicesRestApiToInvoiceClientInterface;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Invoice\InvoiceReaderInterface;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Mapper\InvoiceResourceMapper;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Mapper\InvoiceResourceMapperInterface;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiValidator;
use FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class InvoicesRestApiFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Glue\OrdersRestApi\Processor\Order\OrderReaderInterface
     */
    public function createInvoiceReader(): InvoiceReaderInterface
    {
        return new InvoiceReader(
            $this->getInvoiceClient(),
            $this->createInvoiceResourceMapper(),
            $this->getResourceBuilder(),
            $this->createRestApiError(),
            $this->createRestApiValidator()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\InvoiceRestApi\Dependency\Client\InvoicesRestApiToInvoiceClientInterface
     */
    public function getInvoiceClient(): InvoicesRestApiToInvoiceClientInterface
    {
        return $this->getProvidedDependency(InvoicesRestApiDependencyProvider::CLIENT_INVOICE);
    }

    /**
     * @return \FondOfSpyker\Glue\InvoicesRestApi\Processor\Mapper\InvoicesResourceMapperInterface
     */
    public function createInvoiceResourceMapper(): InvoiceResourceMapperInterface
    {
        return new InvoiceResourceMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    public function createRestApiValidator(): RestApiValidatorInterface
    {
        return new RestApiValidator($this->createRestApiError());
    }

    /**
     * @return \FondOfSpryker\Glue\InvoicesRestApi\Processor\Validation\RestApiErrorInterface
     */
    public function createRestApiError(): RestApiErrorInterface
    {
        return new RestApiError();
    }
}
