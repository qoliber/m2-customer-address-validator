<?php
/**
 * Created by Qoliber
 *
 * @category    Qoliber
 * @package     Qoliber_CustomerAddressValidator
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\CustomerAddressValidator\Plugin\CustomerGraphQl;

use Magento\Customer\Api\Data\AddressInterface;
use Magento\CustomerGraphQl\Model\Customer\Address\ValidateAddress as Subject;
use Qoliber\CustomerAddressValidator\Plugin\AbstractPlugin;

class ValidateInputs extends AbstractPlugin
{
    /**
     * After execute.
     *
     * @param \Magento\CustomerGraphQl\Model\Customer\Address\ValidateAddress $validator
     * @param $result
     * @param \Magento\Customer\Api\Data\AddressInterface $address
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterExecute(
        Subject $validator,
        $result,
        AddressInterface $address
    ): void {
        parent::validate($address);
    }
}
