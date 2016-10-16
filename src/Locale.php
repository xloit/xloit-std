<?php
/**
 * This source file is part of Xloit project.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License that is bundled with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * <http://www.opensource.org/licenses/mit-license.php>
 * If you did not receive a copy of the license and are unable to obtain it through the world-wide-web,
 * please send an email to <license@xloit.com> so we can send you a copy immediately.
 *
 * @license   MIT
 * @link      http://xloit.com
 * @copyright Copyright (c) 2016, Xloit. All rights reserved.
 */

namespace Xloit\Std;

use Locale as AbstractLocale;

/**
 * A {@link Locale} class.
 *
 * @package Xloit\Std
 */
class Locale extends AbstractLocale
{
    /**
     * Retrieve locale option list.
     *
     * @return array
     */
    public static function getOptionLocales()
    {
        /** @noinspection SpellCheckingInspection */
        return [
            'af-ZA'  => 'Afrikaans (South Africa)',
            'ar-DZ'  => 'Arabic (Algeria)',
            'ar-EG'  => 'Arabic (Egypt)',
            'ar-KW'  => 'Arabic (Kuwait)',
            'ar-MA'  => 'Arabic (Morocco)',
            'ar-SA'  => 'Arabic (Saudi Arabia)',
            'az-AZ'  => 'Azerbaijani (Azerbaijan)',
            'be-BY'  => 'Belarusian (Belarus)',
            'bg-BG'  => 'Bulgarian (Bulgaria)',
            'bn-BD'  => 'Bengali (Bangladesh)',
            'bs-BA'  => 'Bosnian (Bosnia and Herzegovina)',
            'ca-ES'  => 'Catalan (Spain)',
            'cs-CZ'  => 'Czech (Czech Republic)',
            'cy-GB'  => 'Welsh (United Kingdom)',
            'da-DK'  => 'Danish (Denmark)',
            'de-AT'  => 'German (Austria)',
            'de-CH'  => 'German (Switzerland)',
            'de-DE'  => 'German (Germany)',
            'el-GR'  => 'Greek (Greece)',
            'en-AU'  => 'English (Australia)',
            'en-CA'  => 'English (Canada)',
            'en-GB'  => 'English (United Kingdom)',
            'en-IE'  => 'English (Ireland)',
            'en-NZ'  => 'English (New Zealand)',
            'en-US'  => 'English (United States)',
            'es-AR'  => 'Spanish (Argentina)',
            'es-CL'  => 'Spanish (Chile)',
            'es-CO'  => 'Spanish (Colombia)',
            'es-CR'  => 'Spanish (Costa Rica)',
            'es-ES'  => 'Spanish (Spain)',
            'es-MX'  => 'Spanish (Mexico)',
            'es-PA'  => 'Spanish (Panama)',
            'es-PE'  => 'Spanish (Peru)',
            'es-VE'  => 'Spanish (Venezuela)',
            'et-EE'  => 'Estonian (Estonia)',
            'fa-IR'  => 'Persian (Iran)',
            'fi-FI'  => 'Finnish (Finland)',
            'fil-PH' => 'Filipino (Philippines)',
            'fr-CA'  => 'French (Canada)',
            'fr-FR'  => 'French (France)',
            'gl-ES'  => 'Galician (Spain)',
            'gu-IN'  => 'Gujarati (India)',
            'he-IL'  => 'Hebrew (Israel)',
            'hi-IN'  => 'Hindi (India)',
            'hr-HR'  => 'Croatian (Croatia)',
            'hu-HU'  => 'Hungarian (Hungary)',
            'id-ID'  => 'Indonesian (Indonesia)',
            'is-IS'  => 'Icelandic (Iceland)',
            'it-CH'  => 'Italian (Switzerland)',
            'it-IT'  => 'Italian (Italy)',
            'ja-JP'  => 'Japanese (Japan)',
            'ka-GE'  => 'Georgian (Georgia)',
            'km-KH'  => 'Khmer (Cambodia)',
            'ko-KR'  => 'Korean (South Korea)',
            'lo-LA'  => 'Lao (Laos)',
            'lt-LT'  => 'Lithuanian (Lithuania)',
            'lv-LV'  => 'Latvian (Latvia)',
            'mk-MK'  => 'Macedonian (Macedonia)',
            'mn-MN'  => 'Mongolian (Mongolia)',
            'ms-MY'  => 'Malay (Malaysia)',
            'nb-NO'  => 'Norwegian Bokmål (Norway)',
            'nl-NL'  => 'Dutch (Netherlands)',
            'nn-NO'  => 'Norwegian Nynorsk (Norway)',
            'pl-PL'  => 'Polish (Poland)',
            'pt-BR'  => 'Portuguese (Brazil)',
            'pt-PT'  => 'Portuguese (Portugal)',
            'ro-RO'  => 'Romanian (Romania)',
            'ru-RU'  => 'Russian (Russia)',
            'sk-SK'  => 'Slovak (Slovakia)',
            'sl-SI'  => 'Slovenian (Slovenia)',
            'sq-AL'  => 'Albanian (Albania)',
            'sr-RS'  => 'Serbian (Serbia)',
            'sv-SE'  => 'Swedish (Sweden)',
            'sw-KE'  => 'Swahili (Kenya)',
            'th-TH'  => 'Thai (Thailand)',
            'tr-TR'  => 'Turkish (Turkey)',
            'uk-UA'  => 'Ukrainian (Ukraine)',
            'vi-VN'  => 'Vietnamese (Vietnam)',
            'zh-CN'  => 'Chinese (China)',
            'zh-HK'  => 'Chinese (Hong Kong SAR China)',
            'zh-TW'  => 'Chinese (Taiwan)'
        ];
    }

    /**
     * Retrieve timezone option list.
     *
     * @return array
     */
    public static function getOptionTimezones()
    {
        /** @noinspection SpellCheckingInspection */
        return [
            'Etc/GMT+12'           => 'Dateline Standard Time (Etc/GMT+12)',
            'Etc/GMT+11'           => 'UTC-11 (Etc/GMT+11)',
            'Pacific/Honolulu'     => 'Hawaiian Standard Time (Pacific/Honolulu)',
            'America/Anchorage'    => 'Alaskan Standard Time (America/Anchorage)',
            'America/Santa_Isabel' => 'Pacific Standard Time (Mexico) (America/Santa_Isabel)',
            'America/Los_Angeles'  => 'Pacific Standard Time (America/Los_Angeles)',
            'America/Phoenix'      => 'US Mountain Standard Time (America/Phoenix)',
            'America/Chihuahua'    => 'Mountain Standard Time (Mexico) (America/Chihuahua)',
            'America/Denver'       => 'Mountain Standard Time (America/Denver)',
            'America/Guatemala'    => 'Central America Standard Time (America/Guatemala)',
            'America/Chicago'      => 'Central Standard Time (America/Chicago)',
            'America/Mexico_City'  => 'Central Standard Time (Mexico) (America/Mexico_City)',
            'America/Regina'       => 'Canada Central Standard Time (America/Regina)',
            'America/Bogota'       => 'SA Pacific Standard Time (America/Bogota)',
            'America/New_York'     => 'Eastern Standard Time (America/New_York)',
            'America/Indianapolis' => 'US Eastern Standard Time (America/Indianapolis)',
            'America/Caracas'      => 'Venezuela Standard Time (America/Caracas)',
            'America/Asuncion'     => 'Paraguay Standard Time (America/Asuncion)',
            'America/Halifax'      => 'Atlantic Standard Time (America/Halifax)',
            'America/Cuiaba'       => 'Central Brazilian Standard Time (America/Cuiaba)',
            'America/La_Paz'       => 'SA Western Standard Time (America/La_Paz)',
            'America/Santiago'     => 'Pacific SA Standard Time (America/Santiago)',
            'America/St_Johns'     => 'Newfoundland Standard Time (America/St_Johns)',
            'America/Sao_Paulo'    => 'E. South America Standard Time (America/Sao_Paulo)',
            'America/Buenos_Aires' => 'Argentina Standard Time (America/Buenos_Aires)',
            'America/Cayenne'      => 'SA Eastern Standard Time (America/Cayenne)',
            'America/Godthab'      => 'Greenland Standard Time (America/Godthab)',
            'America/Montevideo'   => 'Montevideo Standard Time (America/Montevideo)',
            'America/Bahia'        => 'Bahia Standard Time (America/Bahia)',
            'Etc/GMT+2'            => 'UTC-02 (Etc/GMT+2)',
            'Atlantic/Azores'      => 'Azores Standard Time (Atlantic/Azores)',
            'Atlantic/Cape_Verde'  => 'Cape Verde Standard Time (Atlantic/Cape_Verde)',
            'Africa/Casablanca'    => 'Morocco Standard Time (Africa/Casablanca)',
            'Etc/GMT'              => 'UTC (Etc/GMT)',
            'Europe/London'        => 'GMT Standard Time (Europe/London)',
            'Atlantic/Reykjavik'   => 'Greenwich Standard Time (Atlantic/Reykjavik)',
            'Europe/Berlin'        => 'W. Europe Standard Time (Europe/Berlin)',
            'Europe/Budapest'      => 'Central Europe Standard Time (Europe/Budapest)',
            'Europe/Paris'         => 'Romance Standard Time (Europe/Paris)',
            'Europe/Warsaw'        => 'Central European Standard Time (Europe/Warsaw)',
            'Africa/Lagos'         => 'W. Central Africa Standard Time (Africa/Lagos)',
            'Africa/Windhoek'      => 'Namibia Standard Time (Africa/Windhoek)',
            'Europe/Bucharest'     => 'GTB Standard Time (Europe/Bucharest)',
            'Asia/Beirut'          => 'Middle East Standard Time (Asia/Beirut)',
            'Africa/Cairo'         => 'Egypt Standard Time (Africa/Cairo)',
            'Asia/Damascus'        => 'Syria Standard Time (Asia/Damascus)',
            'Africa/Johannesburg'  => 'South Africa Standard Time (Africa/Johannesburg)',
            'Europe/Kiev'          => 'FLE Standard Time (Europe/Kiev)',
            'Europe/Istanbul'      => 'Turkey Standard Time (Europe/Istanbul)',
            'Asia/Jerusalem'       => 'Israel Standard Time (Asia/Jerusalem)',
            'Africa/Tripoli'       => 'Libya Standard Time (Africa/Tripoli)',
            'Asia/Amman'           => 'Jordan Standard Time (Asia/Amman)',
            'Asia/Baghdad'         => 'Arabic Standard Time (Asia/Baghdad)',
            'Europe/Kaliningrad'   => 'Kaliningrad Standard Time (Europe/Kaliningrad)',
            'Asia/Riyadh'          => 'Arab Standard Time (Asia/Riyadh)',
            'Africa/Nairobi'       => 'E. Africa Standard Time (Africa/Nairobi)',
            'Asia/Tehran'          => 'Iran Standard Time (Asia/Tehran)',
            'Asia/Dubai'           => 'Arabian Standard Time (Asia/Dubai)',
            'Asia/Baku'            => 'Azerbaijan Standard Time (Asia/Baku)',
            'Europe/Moscow'        => 'Russian Standard Time (Europe/Moscow)',
            'Indian/Mauritius'     => 'Mauritius Standard Time (Indian/Mauritius)',
            'Asia/Tbilisi'         => 'Georgian Standard Time (Asia/Tbilisi)',
            'Asia/Yerevan'         => 'Caucasus Standard Time (Asia/Yerevan)',
            'Asia/Kabul'           => 'Afghanistan Standard Time (Asia/Kabul)',
            'Asia/Tashkent'        => 'West Asia Standard Time (Asia/Tashkent)',
            'Asia/Karachi'         => 'Pakistan Standard Time (Asia/Karachi)',
            'Asia/Calcutta'        => 'India Standard Time (Asia/Calcutta)',
            'Asia/Colombo'         => 'Sri Lanka Standard Time (Asia/Colombo)',
            'Asia/Katmandu'        => 'Nepal Standard Time (Asia/Katmandu)',
            'Asia/Almaty'          => 'Central Asia Standard Time (Asia/Almaty)',
            'Asia/Dhaka'           => 'Bangladesh Standard Time (Asia/Dhaka)',
            'Asia/Yekaterinburg'   => 'Ekaterinburg Standard Time (Asia/Yekaterinburg)',
            'Asia/Rangoon'         => 'Myanmar Standard Time (Asia/Rangoon)',
            'Asia/Bangkok'         => 'SE Asia Standard Time (Asia/Bangkok)',
            'Asia/Novosibirsk'     => 'N. Central Asia Standard Time (Asia/Novosibirsk)',
            'Asia/Shanghai'        => 'China Standard Time (Asia/Shanghai)',
            'Asia/Krasnoyarsk'     => 'North Asia Standard Time (Asia/Krasnoyarsk)',
            'Asia/Singapore'       => 'Singapore Standard Time (Asia/Singapore)',
            'Australia/Perth'      => 'W. Australia Standard Time (Australia/Perth)',
            'Asia/Taipei'          => 'Taipei Standard Time (Asia/Taipei)',
            'Asia/Ulaanbaatar'     => 'Ulaanbaatar Standard Time (Asia/Ulaanbaatar)',
            'Asia/Irkutsk'         => 'North Asia East Standard Time (Asia/Irkutsk)',
            'Asia/Tokyo'           => 'Tokyo Standard Time (Asia/Tokyo)',
            'Asia/Seoul'           => 'Korea Standard Time (Asia/Seoul)',
            'Australia/Adelaide'   => 'Cen. Australia Standard Time (Australia/Adelaide)',
            'Australia/Darwin'     => 'AUS Central Standard Time (Australia/Darwin)',
            'Australia/Brisbane'   => 'E. Australia Standard Time (Australia/Brisbane)',
            'Australia/Sydney'     => 'AUS Eastern Standard Time (Australia/Sydney)',
            'Pacific/Port_Moresby' => 'West Pacific Standard Time (Pacific/Port_Moresby)',
            'Australia/Hobart'     => 'Tasmania Standard Time (Australia/Hobart)',
            'Asia/Yakutsk'         => 'Yakutsk Standard Time (Asia/Yakutsk)',
            'Pacific/Guadalcanal'  => 'Central Pacific Standard Time (Pacific/Guadalcanal)',
            'Asia/Vladivostok'     => 'Vladivostok Standard Time (Asia/Vladivostok)',
            'Pacific/Auckland'     => 'New Zealand Standard Time (Pacific/Auckland)',
            'Etc/GMT-12'           => 'UTC+12 (Etc/GMT-12)',
            'Pacific/Fiji'         => 'Fiji Standard Time (Pacific/Fiji)',
            'Asia/Magadan'         => 'Magadan Standard Time (Asia/Magadan)',
            'Pacific/Tongatapu'    => 'Tonga Standard Time (Pacific/Tongatapu)',
            'Pacific/Apia'         => 'Samoa Standard Time (Pacific/Apia)'
        ];
    }

    /**
     * Retrieve countries option list.
     *
     * @return array
     */
    public static function getOptionCountries()
    {
        /** @noinspection SpellCheckingInspection */
        return [
            'AF' => 'Afghanistan',
            'AX' => 'Åland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'VG' => 'British Virgin Islands',
            'BN' => 'Brunei',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo - Brazzaville',
            'CD' => 'Congo - Kinshasa',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Côte d’Ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard & McDonald Islands',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong SAR China',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Laos',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macau SAR China',
            'MK' => 'Macedonia',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia',
            'MD' => 'Moldova',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar (Burma)',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'KP' => 'North Korea',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territories',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn Islands',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'QA' => 'Qatar',
            'RE' => 'Réunion',
            'RO' => 'Romania',
            'RU' => 'Russia',
            'RW' => 'Rwanda',
            'BL' => 'Saint Barthélemy',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'MF' => 'Saint Martin',
            'PM' => 'Saint Pierre and Miquelon',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'São Tomé and Príncipe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia & South Sandwich Islands',
            'KR' => 'South Korea',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'VC' => 'St. Vincent & Grenadines',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syria',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'TL' => 'Timor-Leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UY' => 'Uruguay',
            'UM' => 'U.S. Outlying Islands',
            'VI' => 'U.S. Virgin Islands',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VA' => 'Vatican City',
            'VE' => 'Venezuela',
            'VN' => 'Vietnam',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe'
        ];
    }
}
