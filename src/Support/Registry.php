<?php

declare(strict_types=1);

namespace Pixelpeter\IsoCodesValidation\Support;

final class Registry
{
    /**
     * @var array<string, string> List of rulenames and the matching validator class
     */
    private static array $validators = [
        'abn' => 'IsoCodes\Abn',
        'bban' => 'IsoCodes\Bban',
        'bsn' => 'IsoCodes\Bsn',
        'cif' => 'IsoCodes\Cif',
        'creditcard' => 'IsoCodes\CreditCard',
        'cusip' => 'IsoCodes\Cusip',
        'dun14' => 'IsoCodes\Dun14',
        'ean13' => 'IsoCodes\Ean13',
        'ean8' => 'IsoCodes\Ean8',
        'gdti' => 'IsoCodes\Gdti',
        'gln' => 'IsoCodes\Gln',
        'grai' => 'IsoCodes\Grai',
        'gsrn' => 'IsoCodes\Gsrn',
        'gtin' => 'IsoCodes\Gtin',
        'gtin12' => 'IsoCodes\Gtin12',
        'gtin13' => 'IsoCodes\Gtin13',
        'gtin14' => 'IsoCodes\Gtin14',
        'gtin8' => 'IsoCodes\Gtin8',
        'hetu' => 'IsoCodes\Hetu',
        'iban' => 'IsoCodes\Iban',
        'imei' => 'IsoCodes\Imei',
        'insee' => 'IsoCodes\Insee',
        'ipaddress' => 'IsoCodes\IP',
        'ipv4' => 'IsoCodes\IPv4',
        'ipv6' => 'IsoCodes\IPv6',
        'isbn' => 'IsoCodes\Isbn',
        'isin' => 'IsoCodes\Isin',
        'ismn' => 'IsoCodes\Ismn',
        'iso3166a2' => 'IsoCodes\ISO3166A2',
        'isocodeinterface' => 'IsoCodes\IsoCodeInterface',
        'iswc' => 'IsoCodes\Iswc',
        'itf14' => 'IsoCodes\Itf14',
        'luhn' => 'IsoCodes\Luhn',
        'mac' => 'IsoCodes\Mac',
        'nif' => 'IsoCodes\Nif',
        'organisme_type12_norme_b2' => 'IsoCodes\OrganismeType12NormeB2',
        'phonenumber' => 'IsoCodes\PhoneNumber',
        'sedol' => 'IsoCodes\Sedol',
        'siren' => 'IsoCodes\Siren',
        'siret' => 'IsoCodes\Siret',
        'sscc' => 'IsoCodes\Sscc',
        'ssn' => 'IsoCodes\Ssn',
        'structured_communication' => 'IsoCodes\StructuredCommunication',
        'swift_bic' => 'IsoCodes\SwiftBic',
        'udi' => 'IsoCodes\Udi',
        'uid' => 'IsoCodes\Uid',
        'uknin' => 'IsoCodes\Uknin',
        'upca' => 'IsoCodes\Upca',
        'vat' => 'IsoCodes\Vat',
        'vinna' => 'IsoCodes\VinNA',
        'zipcode' => 'IsoCodes\ZipCode',
    ];

    /**
     * @return list<string>
     */
    public static function ruleNames(): array
    {
        return array_keys(self::$validators);
    }

    public static function validatorClassForRule(string $rule): string
    {
        return fluent(self::$validators)->get($rule, '');
    }
}
