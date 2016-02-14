<?php

namespace CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="CustomerBundle\Repository\CustomerRepository")
 */
class Customer
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
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=255)
     */
    private $shortName;

    /**
     * @var string
     *
     * @ORM\Column(name="nip", type="string", length=255, unique=true)
     */
    private $nip;

    /**
     * @var string
     *
     * @ORM\Column(name="regon", type="string", length=255)
     */
    private $regon;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=8)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="number_house", type="string", length=255)
     */
    private $numberHouse;

    /**
     * @var string
     *
     * @ORM\Column(name="number_apartament", type="string", length=255)
     */
    private $numberApartament;

    /**
     * @var string
     *
     * @ORM\Column(name="web_page", type="string", length=255)
     */
    private $webPage;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=255)
     */
    private $phoneNumber;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;


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
     * @return Customer
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
     * Set shortName
     *
     * @param string $shortName
     * @return Customer
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set nip
     *
     * @param string $nip
     * @return Customer
     */
    public function setNip($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get nip
     *
     * @return string 
     */
    public function getNip()
    {
        return $this->nip;
    }

    /**
     * Set regon
     *
     * @param string $regon
     * @return Customer
     */
    public function setRegon($regon)
    {
        $this->regon = $regon;

        return $this;
    }

    /**
     * Get regon
     *
     * @return string 
     */
    public function getRegon()
    {
        return $this->regon;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return Customer
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string 
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Customer
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set numberHouse
     *
     * @param string $numberHouse
     * @return Customer
     */
    public function setNumberHouse($numberHouse)
    {
        $this->numberHouse = $numberHouse;

        return $this;
    }

    /**
     * Get numberHouse
     *
     * @return string 
     */
    public function getNumberHouse()
    {
        return $this->numberHouse;
    }

    /**
     * Set numberApartament
     *
     * @param string $numberApartament
     * @return Customer
     */
    public function setNumberApartament($numberApartament)
    {
        $this->numberApartament = $numberApartament;

        return $this;
    }

    /**
     * Get numberApartament
     *
     * @return string 
     */
    public function getNumberApartament()
    {
        return $this->numberApartament;
    }

    /**
     * Set webPage
     *
     * @param string $webPage
     * @return Customer
     */
    public function setWebPage($webPage)
    {
        $this->webPage = $webPage;

        return $this;
    }

    /**
     * Get webPage
     *
     * @return string 
     */
    public function getWebPage()
    {
        return $this->webPage;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Customer
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    
    /**
     * Set dateAdd
     *
     * @param string $dateAdd
     * @return Customer
     */
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd
     *
     * @return string 
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }    
    
    /**
     * @ORM\ManyToOne(targetEntity="Payment", inversedBy="customers")
     * @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     */
    protected $payment;

    /**
     * Set payment
     *
     * @param \CustomerBundle\Entity\Payment $payment
     * @return Customer
     */
    public function setPayment(\CustomerBundle\Entity\Payment $payment = null)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return \CustomerBundle\Entity\Payment 
     */
    public function getPayment()
    {
        return $this->payment;
    }
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Discount", inversedBy="customers")
     * @ORM\JoinColumn(name="discount_id", referencedColumnName="id")
     */
    protected $discount;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="CustomerType", inversedBy="customers")
     * @ORM\JoinColumn(name="customer_type_id", referencedColumnName="id")
     */
    protected $customerType;

    /**
     * Set discount
     *
     * @param \CustomerBundle\Entity\Discount $discount
     * @return Customer
     */
    public function setDiscount(\CustomerBundle\Entity\Discount $discount = null)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return \CustomerBundle\Entity\Discount 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set customerType
     *
     * @param \CustomerBundle\Entity\CustomerType $customerType
     * @return Customer
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
    
    
    
     /**
     * @ORM\OneToMany(targetEntity="Note", mappedBy="customer")
     */
    protected $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    /**
     * Add notes
     *
     * @param \CustomerBundle\Entity\Note $notes
     * @return Customer
     */
    public function addNote(\CustomerBundle\Entity\Note $notes)
    {
        $this->notes[] = $notes;

        return $this;
    }

    /**
     * Remove notes
     *
     * @param \CustomerBundle\Entity\Note $notes
     */
    public function removeNote(\CustomerBundle\Entity\Note $notes)
    {
        $this->notes->removeElement($notes);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotes()
    {
        return $this->notes;
    }
}
