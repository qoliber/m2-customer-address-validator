<?php
/**
 * Created by Qoliber
 *
 * @category    Qoliber
 * @package     Qoliber_CustomerAddressValidator
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\CustomerAddressValidator\Model;

class Validator
{
    /** @var string */
    private const PATTERN = '/[{}<>%]/';

    /**
     * Validate field.
     *
     * @param string|null $value
     *
     * @return bool
     */
    public function validate(
        ?string $value
    ): bool {
        return $this->isValid($value);
    }

    /**
     * Check if field is valid.
     *
     * @param string|null $value
     *
     * @return bool
     */
    private function isValid(?string $value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (preg_match(self::PATTERN, $value, $matches)) {
            return $matches[0] === $value;
        }

        return true;
    }
}
