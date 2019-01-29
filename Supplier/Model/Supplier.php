<?php


declare(strict_types=1);

namespace Iqmosaic\Supplier\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Iqmosaic\Supplier\Model\ResourceModel\Supplier as SupplierResourceModel;
use Iqmosaic\SupplierApi\Api\Data\SupplierInterface;

class Supplier extends AbstractExtensibleModel implements SupplierInterface
{

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(SupplierResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function getSupplierId(): ?int
    {
        return $this->getData(self::SUPPLIER_ID) === null ?
            null:
            (int)$this->getData(self::SUPPLIER_ID);
    }

    /**
     * @inheritdoc
     */
    public function setSupplierId(?int $supplierId): void
    {
        $this->setData(self::SUPPLIER_ID, $supplierId);
    }

    /**
     * @inheritdoc
     */
    public function getUserId(): ?int
    {
        return $this->getData(self::USER_ID) === null ?
            null:
            (int)$this->getData(self::USER_ID);
    }

    /**
     * @inheritdoc
     */
    public function setUserId(?int $customerId): void
    {
        $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritdoc
     */
    public function getEmail(): ?string
    {
        return $this->getData(self::EMAIL) === null ?
            null:
            (string)$this->getData(self::EMAIL);
    }

    /**
     * @inheritdoc
     */
    public function setEmail(?string $email): void
    {
        $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritdoc
     */
    public function getCompanyName(): ?string
    {
        return $this->getData(self::COMPANY_NAME) === null ?
            null:
            (string)$this->getData(self::COMPANY_NAME);
    }

    /**
     * @inheritdoc
     */
    public function setCompanyName(?string $companyName): void
    {
        $this->setData(self::COMPANY_NAME, $companyName);
    }

    /**
     * @inheritdoc
     */
    public function getContactName(): ?string
    {
        return $this->getData(self::CONTACT_NAME) === null ?
            null:
            (string)$this->getData(self::CONTACT_NAME);
    }

    /**
     * @inheritdoc
     */
    public function setContactName(?string $contactName): void
    {
        $this->setData(self::CONTACT_NAME, $contactName);
    }


    /**
     * @inheritdoc
     */
    public function getContactPhone(): ?string
    {
        return $this->getData(self::CONTACT_PHONE) === null ?
            null:
            (string)$this->getData(self::CONTACT_PHONE);
    }

    /**
     * @inheritdoc
     */
    public function setContactPhone(?string $contactPhone): void
    {
        $this->setData(self::CONTACT_PHONE, $contactPhone);
    }

    /**
     * @inheritdoc
     */
    public function getWebsite(): ?string
    {
        return $this->getData(self::WEBSITE) === null ?
            null:
            (string)$this->getData(self::WEBSITE);
    }

    /**
     * @inheritdoc
     */
    public function setWebsite(?string $website): void
    {
        $this->setData(self::WEBSITE, $website);
    }

    /**
     * @inheritdoc
     */
    public function getStreet(): ?string
    {
        return $this->getData(self::STREET) === null ?
            null:
            (string)$this->getData(self::STREET);
    }

    /**
     * @inheritdoc
     */
    public function setStreet(?string $street): void
    {
        $this->setData(self::STREET, $street);
    }

    /**
     * @inheritdoc
     */
    public function getCity(): ?string
    {
        return $this->getData(self::CITY) === null ?
            null:
            (string)$this->getData(self::CITY);
    }

    /**
     * @inheritdoc
     */
    public function setCity(?string $city): void
    {
        $this->setData(self::CITY, $city);
    }

    /**
     * @inheritdoc
     */
    public function getRegion(): ?string
    {
        return $this->getData(self::REGION) === null ?
            null:
            (string)$this->getData(self::REGION);
    }

    /**
     * @inheritdoc
     */
    public function setRegion(?string $region): void
    {
        $this->setData(self::REGION, $region);
    }

    /**
     * @inheritdoc
     */
    public function getPostcode(): ?string
    {
        return $this->getData(self::POSTCODE) === null ?
            null:
            (string)$this->getData(self::POSTCODE);
    }

    /**
     * @inheritdoc
     */
    public function setPostcode(?string $postcode): void
    {
        $this->setData(self::POSTCODE, $postcode);
    }

    /**
     * @inheritdoc
     */
    public function getApproved(): ?string
    {
        return $this->getData(self::APPROVED) === null ?
            null:
            (string)$this->getData(self::APPROVED);
    }

    /**
     * @inheritdoc
     */
    public function setApproved(?string $approved): void
    {
        $this->setData(self::APPROVED, $approved);
    }

    /**
     * @inheritdoc
     */
    public function getAutoUpdateStock(): ?int
    {
        return $this->getData(self::AUTO_UPDATE_STOCK) === null ?
            null:
            (int) $this->getData(self::APPROVED);
    }

    /**
     * @inheritdoc
     */
    public function setAutoUpdateStock(?int $autoUpdateStock): void
    {
        $this->setData(self::AUTO_UPDATE_STOCK, $autoUpdateStock);
    }

    /**
     * @inheritdoc
     */
    public function getNotes(): ?string
    {
        return $this->getData(self::NOTES) === null ?
            null:
            (string) $this->getData(self::NOTES);
    }

    /**
     * @inheritdoc
     */
    public function setNotes(?string $notes): void
    {
        $this->setData(self::NOTES, $notes);
    }

    /**
     * @inheritdoc
     */
    public function getCountryId(): ?string
    {
        return $this->getData(self::COUNTRY_ID) === null ?
            null:
            (string) $this->getData(self::COUNTRY_ID);
    }

    /**
     * @inheritdoc
     */
    public function setCountryId(?string $countryId): void
    {
        $this->setData(self::COUNTRY_ID, $countryId);
    }

    /**
     * @inheritdoc
     */
    public function getRegionId(): ?string
    {
        return $this->getData(self::REGION_ID) === null ?
            null:
            (string) $this->getData(self::REGION_ID);
    }

    /**
     * @inheritdoc
     */
    public function setRegionId(?string $regionId): void
    {
        $this->setData(self::REGION_ID, $regionId);
    }

}