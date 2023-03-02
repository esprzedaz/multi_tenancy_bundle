<?php


namespace Hakam\MultiTenancyBundle\EventListener;


use Hakam\MultiTenancyBundle\Doctrine\DBAL\TenantConnection;
use Hakam\MultiTenancyBundle\Event\SwitchDbEvent;
use Hakam\MultiTenancyBundle\Services\DbConfigService;
use Hakam\MultiTenancyBundle\Services\TenantContext;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author Ramy Hakam <pencilsoft1@gmail.com>
 */
class DbSwitchEventListener implements EventSubscriberInterface
{
    public function __construct(
        private readonly ContainerInterface $container,
        private readonly DbConfigService $dbConfigService,
        private readonly TenantContext $tenantContext
    ) {
    }

    public static function getSubscribedEvents()
    {
        return
            [
                SwitchDbEvent::class => 'onHakamMultiTenancyBundleEventSwitchDbEvent'
            ];
    }

    public function onHakamMultiTenancyBundleEventSwitchDbEvent(SwitchDbEvent $switchDbEvent)
    {
        $dbConfig = $this->dbConfigService->findDbConfig($switchDbEvent->getDbIndex());
        /** @var TenantConnection $tenantConnection */
        $tenantConnection = $this->container->get('doctrine')->getConnection('tenant');
        $tenantConnection->changeParams(
            $dbConfig->getDbHost(),
            $dbConfig->getDbName(),
            $dbConfig->getDbUsername(),
            $dbConfig->getDbPassword()
        );
        $tenantConnection->reconnect();

        $this->tenantContext->init($dbConfig->getKey());
    }
}