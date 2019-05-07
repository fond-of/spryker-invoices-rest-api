<?php

namespace FondOfSpryker\Glue\InvoicesRestApi;

use Spryker\Glue\CartsRestApi\Dependency\Client\CartsRestApiToCartClientBridge;
use Spryker\Glue\CartsRestApi\Dependency\Client\CartsRestApiToPersistentCartClientBridge;
use Spryker\Glue\CartsRestApi\Dependency\Client\CartsRestApiToQuoteClientBridge;
use Spryker\Glue\CartsRestApi\Dependency\Client\CartsRestApiToZedRequestClientBridge;
use Spryker\Glue\CartsRestApi\Exception\MissingQuoteCollectionReaderPluginException;
use Spryker\Glue\CartsRestApi\Exception\MissingQuoteCreatorPluginException;
use Spryker\Glue\CartsRestApiExtension\Dependency\Plugin\QuoteCollectionReaderPluginInterface;
use Spryker\Glue\CartsRestApiExtension\Dependency\Plugin\QuoteCreatorPluginInterface;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \Spryker\Glue\InvoicesRestApi\InvoicesRestApiConfig getConfig()
 */
class InvoicesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_INVOICE = 'CLIENT_INVOICE';
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        //$container = $this->addInvoiceClient($container);
        //$container = $this->addZedRequestClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    /*protected function addInvoiceClient(Container $container): Container
    {
        $container[static::CLIENT_INVOICE] = function (Container $container) {
            return new CartsRestApiToCartClientBridge($container->getLocator()->invoice()->client());
        };

        return $container;
    }*/

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    /*protected function addZedRequestClient(Container $container): Container
    {
        $container[static::CLIENT_ZED_REQUEST] = function (Container $container) {
            return new CartsRestApiToZedRequestClientBridge($container->getLocator()->zedRequest()->client());
        };

        return $container;
    }*/

}
