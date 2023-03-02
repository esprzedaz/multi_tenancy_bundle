<?php


namespace Hakam\MultiTenancyBundle\Services;



use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Hakam\MultiTenancyBundle\Entity\Tenant;
use LogicException;
use RuntimeException;

/**
 * @author Ramy Hakam <pencilsoft1@gmail.com>
 */
class DbConfigService
{
    /**
     * @var ObjectRepository
     */
    private ObjectRepository  $entityRepository;
    /**
     * @var string
     */
    private string $dbIdentifier;

    public function __construct(EntityManagerInterface $entityManager,string $dbClassName, string $dbIdentifier)
    {
        $this->dbIdentifier = $dbIdentifier;
        $this->entityRepository = $entityManager->getRepository($dbClassName);
    }

    public function findDbConfig(string $identifier): TenantDbConfigurationInterface
    {
        if('dev' === $identifier && 'dev' === $_ENV['APP_ENV']){
            $dbConfigObject = new Tenant();
            $dbConfigObject->setKey('dev');
            $dbConfigObject->setDbHost($_ENV['DEV_DATABASE_HOST']);
            $dbConfigObject->setDbName($_ENV['DEV_DATABASE_NAME']);
            $dbConfigObject->setDbUserName($_ENV['DEV_DATABASE_USERNAME']);
            $dbConfigObject->setDbPassword($_ENV['DEV_DATABASE_PASSWORD']);
        }else {
            $dbConfigObject = $this->entityRepository->findOneBy([$this->dbIdentifier => $identifier]);
        }
        if( $dbConfigObject === null )
        {
            throw new RuntimeException(sprintf(
                'Tenant db repository " %s " returns NULL for identifier " %s = %s " ',
                get_class($this->entityRepository),
                $this->dbIdentifier,
                $identifier
            ));
        }

        if( !$dbConfigObject instanceof TenantDbConfigurationInterface)
        {
            throw new LogicException(sprintf(
                'The tenant db entity  " %s ". Should implement " Hakam\MultiTenancyBundle\TenantDbConfigurationInterface " ',
                get_class($dbConfigObject)
            ));
        }
        return $dbConfigObject;
    }
}