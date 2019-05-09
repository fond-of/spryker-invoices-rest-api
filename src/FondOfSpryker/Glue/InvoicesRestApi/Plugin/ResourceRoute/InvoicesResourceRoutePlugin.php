<?php

namespace FondOfSpryker\Glue\InvoicesRestApi\Plugin\ResourceRoute;

use FondOfSpryker\Glue\InvoicesRestApi\InvoicesRestApiConfig;
use Generated\Shared\Transfer\RestInvoicesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Glue\InvoicesRestApi\InvoicesRestApiFactory getFactory()
 */
class InvoicesResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addGet(InvoicesRestApiConfig::ACTION_INVOICES_GET);
            //->addPost(InvoicesRestApiConfig::ACTION_INVOICES_POST);

        return $resourceRouteCollection;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceType(): string
    {
        return InvoicesRestApiConfig::RESOURCE_INVOICES;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public function getController(): string
    {
        return InvoicesRestApiConfig::CONTROLLER_INVOICES;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestInvoicesTransfer::class;
    }
}
