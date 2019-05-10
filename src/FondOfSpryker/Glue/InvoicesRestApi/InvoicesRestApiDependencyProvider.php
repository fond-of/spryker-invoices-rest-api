<?php

namespace FondOfSpryker\Glue\InvoicesRestApi;

use FondOfSpryker\Glue\InvoicesRestApi\Dependency\Client\InvoicesRestApiToInvoiceClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \Spryker\Glue\InvoicesRestApi\InvoicesRestApiConfig getConfig()
 */
class InvoicesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_INVOICE = 'CLIENT_INVOICE';
    public const PLUGINS_INVOICE_POST_CREATE = 'PLUGINS_INVOICE_POST_CREATE';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addInvoiceClient($container);
        $container = $this->addInvoicePostCreatePlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addInvoiceClient(Container $container): Container
    {
        $container[static::CLIENT_INVOICE] = function (Container $container) {
            return new InvoicesRestApiToInvoiceClientBridge($container->getLocator()->invoice()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addInvoicePostCreatePlugins(Container $container): Container
    {
        $container[static::PLUGINS_INVOICE_POST_CREATE] = function () {
            return $this->getInvoicePostCreatePlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Glue\InvoicesRestApiExtension\Dependency\Plugin\InvoicePostCreatePluginInterface[]
     */
    protected function getInvoicePostCreatePlugins(): array
    {
        return [];
    }

}
