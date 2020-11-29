<?php

namespace MGS\StoreLocator\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

interface StoreInterface extends CustomAttributesDataInterface
{
    const NAME = 'name';
    const EMAIL = "email";
    const PHONE = 'phone_number';

    /**
     * Get store name
     *
     * @return void
     */
    public function getName();

    /**
     * Set store name
     *
     * @param $name
     * @return void
     */
    public function setName($name);
    /**
     * Get store email
     *
     * @return void
     */
    public function getEmail();

    /**
     * Set store email
     *
     * @param $email
     * @return void
     */
    public function setEmail($email);

    /**
     * Get store phone
     *
     * @param $phone
     * @return void
     */
    public function getPhone();

    /**
     * Set store phone
     *
     * @param $phone
     * @return void
     */
    public function setPhone($phone);
}
