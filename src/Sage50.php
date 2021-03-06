<?php

namespace Smart\Sage50;

use Doctrine\ORM\EntityManagerInterface;
use Smart\Sage50\Doctrine\Doctrine;

class Sage50 extends Container
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param array|Config $config
     */
    public function __construct($config)
    {
        if (is_array($config)) {
            $this->config = new Config($config);
        } elseif ($config instanceof Config) {
            $this->config = $config;
        } else {
            throw new \InvalidArgumentException;
        }
        (new Annotation())->setup();
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        if (null === $this->entityManager) {
            $doctrine = new Doctrine();
            $doctrine->setConfig($this->config);
            $this->entityManager = $doctrine->getEntityManager();
        }
        return $this->entityManager;
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return $this
     */
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Config $config
     * @return $this
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
        return $this;
    }
}
