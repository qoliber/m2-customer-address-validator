<?php
/**
 * Created by Qoliber
 *
 * @category    Qoliber
 * @package     Qoliber_CustomerAddressValidator
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\CustomerAddressValidator\Plugin\Quote;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Model\QuoteAddressValidator as Subject;
use Qoliber\CustomerAddressValidator\Plugin\AbstractPlugin;

class ValidateInputs extends AbstractPlugin
{

    /**
     * After execute.
     *
     * @param \Magento\Quote\Model\QuoteAddressValidator $validator
     * @param bool $result
     * @param \Magento\Quote\Api\Data\AddressInterface $addressData
     *
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterValidate(
        Subject $validator,
        bool $result,
        AddressInterface $addressData
    ): bool {
        parent::validate($addressData);

        return true;
    }

    /**
     * After Validate For Cart.
     *
     * @param \Magento\Quote\Model\QuoteAddressValidator $validator
     * @param $result
     * @param \Magento\Quote\Api\Data\CartInterface $cart
     * @param \Magento\Quote\Api\Data\AddressInterface $address
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterValidateForCart(
        Subject $validator,
        $result,
        CartInterface $cart,
        AddressInterface $address
    ): void {
        parent::validate($address);
    }
}
