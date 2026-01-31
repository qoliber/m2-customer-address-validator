# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.6] - 2024

### Added
- XSS attack prevention for customer and quote address inputs by blocking malicious characters
- Regex pattern `/[{}<>%]/` to detect and reject potentially dangerous characters in address fields
- Comprehensive validation for all address input fields:
  - First name, middle name, last name
  - Prefix and suffix
  - Telephone and fax numbers
  - VAT ID
  - Postcode
  - Company name
  - City
  - Region (including nested `RegionInterface` object support)
  - Street (multi-line validation for array-based street addresses)
- Plugin `ValidateInputs` for CustomerGraphQL module to protect GraphQL mutations
- Plugin `ValidateInputs` for Quote module to validate address data during checkout
- `InputsValidator` extending `\Magento\Framework\Validator\AbstractValidator` for reusable validation logic
- Validation rules defined in `etc/validation.xml`
- Support for both `\Magento\Customer\Api\Data\AddressInterface` and `\Magento\Quote\Api\Data\AddressInterface`

### Security
- Prevents XSS injection attacks through address form fields by rejecting input containing `{`, `}`, `<`, `>`, `%` characters
- Protects both REST API and GraphQL endpoints
- Validates data at plugin level before persistence to database

### Technical Details
- Uses PHP 8.1+ union types for `AddressInterface|QuoteAddressInterface` type hints
- Constructor property promotion with `readonly` modifier for immutability
- Returns descriptive validation error messages for each invalid field
- Compatible with Magento 2.4.6+ and requires PHP >=8.1
