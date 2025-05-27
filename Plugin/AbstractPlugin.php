<?php
/**
 * Created by Qoliber
 *
 * @category    Qoliber
 * @package     Qoliber_CustomerAddressValidator
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\CustomerAddressValidator\Plugin;

use Magento\Customer\Api\Data\AddressInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Api\Data\AddressInterface as QuoteAddressInterface;
use Qoliber\CustomerAddressValidator\Model\Address\InputsValidator as Validator;

class AbstractPlugin
{
    /**
     * @param \Qoliber\CustomerAddressValidator\Model\Address\InputsValidator $validator
     */
    public function __construct(
        private readonly Validator $validator
    ) {
    }

    /**
     * Validate.
     *
     * @param \Magento\Customer\Api\Data\AddressInterface|\Magento\Quote\Api\Data\AddressInterface $address
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function validate(
        AddressInterface|QuoteAddressInterface $address
    ): void {
        $this->validator->isValid($address);

        foreach (array_unique($this->validator->getMessages()) as $message) {
            throw new LocalizedException(__($message));
        }
    }
}
