<?php


namespace Hakam\MultiTenancyBundle\Services;

/**
 * @author Ramy Hakam <pencilsoft1@gmail.com>
 */
Interface TenantDbConfigurationInterface
{
    /**
     * Tenant database name
     * @return string
     */
    public function getDbName(): string;

    /**
     * Tenant database user name
     * @return string
     */
    public function getDbUsername(): string;

    /**
     * Tenant database password
     * @return string|null
     */
    public function getDbPassword(): ?string;

    /**
     * Tenant database host
     * @return string
     */
    public function getDbHost(): string;
}