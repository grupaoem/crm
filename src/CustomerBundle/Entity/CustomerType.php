<?php

namespace CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerType
 *
 * @ORM\Table(name="customer_type")
 * @ORM\Entity(repositoryClass="CustomerBundle\Repository\CustomerTypeRepository")
 */
class CustomerType
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CustomerType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="CustomerType", inversedBy="customer")
     * @ORM\JoinColumn(name="customer_type_id", referencedColumnName="id")
     */
    protected $customerType;

    /**
     * Set customerType
     *
     * @param \CustomerBundle\Entity\CustomerType $customerType
     * @return CustomerType
     */
    public function setCustomerType(\CustomerBundle\Entity\CustomerType $customerType = null)
    {
        $this->customerType = $customerType;

        return $this;
    }

    /**
     * Get customerType
     *
     * @return \CustomerBundle\Entity\CustomerType 
     */
    public function getCustomerType()
    {
        return $this->customerType;
    }
}
