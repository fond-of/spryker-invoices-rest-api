<?php

namespace Spryker\Glue\OrdersRestApi;

use Spryker\Glue\InvoiceRestApi\Processor\Order\InvoiceReader;
use Spryker\Glue\Kernel\AbstractFactory;
use Spryker\Glue\OrdersRestApi\Dependency\Client\OrdersRestApiToSalesClientInterface;
use Spryker\Glue\OrdersRestApi\Processor\Expander\OrderByOrderReferenceResourceRelationshipExpander;
use Spryker\Glue\OrdersRestApi\Processor\Expander\OrderByOrderReferenceResourceRelationshipExpanderInterface;
use Spryker\Glue\OrdersRestApi\Processor\Mapper\OrderResourceMapper;
use Spryker\Glue\OrdersRestApi\Processor\Mapper\OrderResourceMapperInterface;
use Spryker\Glue\OrdersRestApi\Processor\Order\OrderReader;
use Spryker\Glue\OrdersRestApi\Processor\Order\OrderReaderInterface;

class InvoicesRestApiFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Glue\OrdersRestApi\Processor\Order\OrderReaderInterface
     */
    public function createInvoicesReader(): InvoicesReaderInterface
    {
        return new InvoiceReader(
            $this->getSalesClient(),
            $this->getResourceBuilder(),
            $this->createOrderResourceMapper()
        );
    }

    /**
     * @return \Spryker\Glue\OrdersRestApi\Processor\Mapper\OrderResourceMapperInterface
     */
    public function createOrderResourceMapper(): OrderResourceMapperInterface
    {
        return new OrderResourceMapper();
    }

    /**
     * @return \Spryker\Glue\OrdersRestApi\Processor\Expander\OrderByOrderReferenceResourceRelationshipExpanderInterface
     */
    public function createOrderByOrderReferenceResourceRelationshipExpander(): OrderByOrderReferenceResourceRelationshipExpanderInterface
    {
        return new OrderByOrderReferenceResourceRelationshipExpander($this->createOrderReader());
    }

    /**
     * @return \Spryker\Glue\OrdersRestApi\Dependency\Client\OrdersRestApiToSalesClientInterface
     */
    public function getSalesClient(): OrdersRestApiToSalesClientInterface
    {
        return $this->getProvidedDependency(OrdersRestApiDependencyProvider::CLIENT_SALES);
    }
}
