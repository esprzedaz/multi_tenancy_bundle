<?php

namespace Hakam\MultiTenancyBundle\Entity;

use Hakam\MultiTenancyBundle\Services\TenantDbConfigurationInterface;
use Hakam\MultiTenancyBundle\Traits\TenantDbConfigTrait;

class Tenant implements TenantDbConfigurationInterface
{
    use TenantDbConfigTrait;
}
