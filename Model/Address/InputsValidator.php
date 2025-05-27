<?php
/**
 * Created by Qoliber
 *
 * @category    Qoliber
 * @package     Qoliber_CustomerAddressValidator
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\CustomerAddressValidator\Model\Address;

use Magento\Customer\Api\Data\AddressInterface;
use Magento\Framework\Validator\AbstractValidator;
use Magento\Quote\Api\Data\AddressInterface as QuoteAddressInterface;
use Qoliber\CustomerAddressValidator\Model\Validator;

class InputsValidator extends AbstractValidator
{
    /**
     * @param \Qoliber\CustomerAddressValidator\Model\Validator $validator
     */
    public function __construct(private readonly Validator $validator)
    {
    }

    /**
     * Validate fields.
     *
     * @param AddressInterface|QuoteAddressInterface $address
     *
     * @return bool
     */
    public function isValid($address): bool
    {
        $messages = [];

        if (!$this->validator->validate($address->getFirstname())) {
            $messages[] = __('First name is not valid.');
        }

        if (!$this->validator->validate($address->getMiddlename())) {
            $messages[] = __('Middle name is not valid.');
        }

        if (!$this->validator->validate($address->getLastname())) {
            $messages[] = __('Last name is not valid.');
        }

        if (!$this->validator->validate($address->getPrefix())) {
            $messages[] = __('Prefix is not valid.');
        }

        if (!$this->validator->validate($address->getSuffix())) {
            $messages[] = __('Suffix is not valid.');
        }

        if (!$this->validator->validate($address->getTelephone())) {
            $messages[] = __('Telephone is not valid.');
        }

        if (!$this->validator->validate($address->getVatId())) {
            $messages[] = __('VAT ID is not valid.');
        }

        if (!$this->validator->validate($address->getPostcode())) {
            $messages[] = __('Postcode is not valid.');
        }

        if (!$this->validator->validate($address->getFax())) {
            $messages[] = __('Fax is not valid.');
        }

        if (!$this->validator->validate($address->getCompany())) {
            $messages[] = __('Company is not valid.');
        }

        if (!$this->validator->validate($address->getCity())) {
            $messages[] = __('City is not valid.');
        }

        if (!$this->validator->validate($address->getCity())) {
            $messages[] = __('City is not valid.');
        }

        if (!$this->validateRegion($address)) {
            $messages[] = __('Region is not valid.');
        }

        if (!$this->validateStreet($address)) {
            $messages[] = __('Street is not valid.');
        }

        if (!empty($messages)) {
            parent::_addMessages($messages);
        }

        return count($this->_messages) == 0;
    }

    /**
     * Validate region.
     *
     * @param AddressInterface|QuoteAddressInterface $address
     *
     * @return bool
     */
    private function validateRegion(
        AddressInterface|QuoteAddressInterface $address
    ): bool {
        $region = $address->getRegion();
        if (empty($region) || is_string($region)) {
            /** @var string $region */
            return $this->validator->validate($region);
        }

        return $this->validator->validate($region->getRegion())
            && $this->validator->validate($region->getRegionCode());
    }

    /**
     * Validate street.
     *
     * @param AddressInterface|QuoteAddressInterface $address
     *
     * @return bool
     */
    private function validateStreet(
        AddressInterface|QuoteAddressInterface $address
    ): bool {
        $street = $address->getStreet();

        if (empty($street)) {
            return true;
        }

        foreach ($street as $streetLine) {
            if (!$this->validator->validate($streetLine)) {
                return false;
            }
        }

        return true;
    }
}
