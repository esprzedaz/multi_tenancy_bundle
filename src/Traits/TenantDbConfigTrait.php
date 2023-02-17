<?phpnamespace Hakam\MultiTenancyBundle\Traits;use Doctrine\ORM\Mapping as ORM;/** *  Trait to add tenant database configuration to an entity. * @author Ramy Hakam <pencilsoft1@gmail.com> */trait TenantDbConfigTrait{    #[ORM\Column(type: "string", length: 255, nullable: false)]    protected  string $dbName;    #[ORM\Column(type: "string", length: 255, nullable: false)]    protected  string $dbUserName;    #[ORM\Column(type: "string", length: 255, nullable: true)]    protected ?string $dbPassword = null;    #[ORM\Column(type: "string", length: 255, nullable: false)]    protected string $dbHost;    public function getDbName(): string    {        return $this->dbName;    }    public function setDbName(string $dbName): self    {        $this->dbName = $dbName;        return $this;    }    public function getDbUserName(): string    {        return $this->dbUserName;    }    public function setDbUserName(string $dbUser): self    {        $this->dbUserName = $dbUser;        return $this;    }    public function getDbPassword(): ?string    {        return $this->dbPassword;    }    public function setDbPassword(?string $dbPassword): self    {        $this->dbPassword = $dbPassword;        return $this;    }    public function getDbHost(): string    {        return $this->dbHost;    }    public function setDbHost(string $dbHost): self    {        $this->dbHost = $dbHost;        return $this;    }}