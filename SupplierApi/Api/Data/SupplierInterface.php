<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Iqmosaic\SupplierApi\Api\Data;

use \Magento\Framework\Api\ExtensibleDataInterface;


/**
 * Represents product aggregation among some different physical storages (in technical words, it is an index)
 *
 * Used fully qualified namespaces in annotations for proper work of WebApi request parser
 *
 * @api
 */
interface SupplierInterface extends ExtensibleDataInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const SUPPLIER_ID = 'supplier_id';
    const CUSTOMER_ID = 'customer_id';
    const EMAIL = 'email';
    const COMPANY_NAME = 'company_name';

    const CONTACT_NAME = 'contact_name';
    const CONTACT_PHONE = 'contact_phone';
    const WEBSITE = 'website';
    const STREET = 'street';
    const CITY = 'city';
    const REGION = 'region';
    const POSTCODE = 'postcode';
    const APPROVED = 'approved';
    const AUTO_UPDATE_STOCK = 'auto_update_stock';
    const NOTES = 'notes';
    const COUNTRY_ID = 'country_id';
    const REGION_ID = 'region_id';


    /**#@-*/

    /**
     * Get stock id
     *
     * @return int|null
     */
    public function getSupplierId(): ?int;

    /**
     * Set stock id
     *
     * @param int|null $supplierId
     * @return void
     */
    public function setSupplierId(?int $supplierId): void;

    /**
     * Get user id
     *
     * @return int|null
     */
    public function getUserId(): ?int;

    /**
     * Set user id
     *
     * @param int|null $customerId
     * @return void
     */
    public function setUserId(?int $customerId): void;


    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * Set email
     *
     * @param string|null $email
     * @return void
     */
    public function setEmail(?string $email): void;

    /**
     * Get company name
     *
     * @return string|null
     */
    public function getCompanyName(): ?string;

    /**
     * Set company name
     *
     * @param string|null $companyName
     * @return void
     */
    public function setCompanyName(?string $companyName): void;


    /**
     * Get contact name
     *
     * @return string|null
     */
    public function getContactName(): ?string;

    /**
     * Set contact name
     *
     * @param string|null $contactName
     * @return void
     */
    public function setContactName(?string $contactName): void;

    /**
     * Get contact phone
     *
     * @return string|null
     */
    public function getContactPhone(): ?string;

    /**
     * Set contact phone
     *
     * @param string|null $contactPhone
     * @return void
     */
    public function setContactPhone(?string $contactPhone): void;

    /**
     * Get website
     *
     * @return string|null
     */
    public function getWebsite(): ?string;

    /**
     * Set website
     *
     * @param string|null $website
     * @return void
     */
    public function setWebsite(?string $website): void;

    /**
     * Get street
     *
     * @return string|null
     */
    public function getStreet(): ?string;

    /**
     * Set street
     *
     * @param string|null $street
     * @return void
     */
    public function setStreet(?string $street): void;


    /**
     * Get city
     *
     * @return string|null
     */
    public function getCity(): ?string;

    /**
     * Set city
     *
     * @param string|null $city
     * @return void
     */
    public function setCity(?string $city): void;

    /**
     * Get region
     *
     * @return string|null
     */
    public function getRegion(): ?string;

    /**
     * Set region
     *
     * @param string|null $region
     * @return void
     */
    public function setRegion(?string $region): void;

    /**
     * Get postcode
     *
     * @return string|null
     */
    public function getPostcode(): ?string;

    /**
     * Set postcode
     *
     * @param string|null $postcode
     * @return void
     */
    public function setPostcode(?string $postcode): void;

    /**
     * Get approved
     *
     * @return string|null
     */
    public function getApproved(): ?string;

    /**
     * Set approved
     *
     * @param string|null $approved
     * @return void
     */
    public function setApproved(?string $approved): void;

    /**
     * Get auto update stock
     *
     * @return int|null
     */
    public function getAutoUpdateStock(): ?int;

    /**
     * Set auto update stock
     *
     * @param int|null $autoUpdateStock
     * @return void
     */
    public function setAutoUpdateStock(?int $autoUpdateStock): void;

    /**
     * Get notes
     *
     * @return string|null
     */
    public function getNotes(): ?string;

    /**
     * Set notes
     *
     * @param string|null $notes
     * @return void
     */
    public function setNotes(?string $notes): void;

    /**
     * Get country id
     *
     * @return string|null
     */
    public function getCountryId(): ?string;

    /**
     * Set country id
     *
     * @param string|null $countryId
     * @return void
     */
    public function setCountryId(?string $countryId): void;

    /**
     * Get region id
     *
     * @return string|null
     */
    public function getRegionId(): ?string;

    /**
     * Set country id
     *
     * @param string|null $regionId
     * @return void
     */
    public function setRegionId(?string $regionId): void;

}
