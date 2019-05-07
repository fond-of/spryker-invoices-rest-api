<?php

namespace FondOfSpryker\Glue\InvoicesRestApi;

use FondOfSpryker\Glue\CustomersRestApi\Dependency\Client\CustomersRestApiToCustomerClientBridge;
use Spryker\Glue\Kernel\Container;
use Spryker\Glue\CustomersRestApi\CustomersRestApiDependencyProvider as SprykerCustomersRestApiDependencyProvider;

/**
 * @method \Spryker\Glue\CustomersRestApi\CustomersRestApiConfig getConfig()
 */
class InvoicesRestApiDependencyProvider extends SprykerCustomersRestApiDependencyProvider
{
    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        return $container;
    }

}
