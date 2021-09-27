# Laravel translation helpers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/isaeken/laravel-translator.svg?style=flat-square)](https://packagist.org/packages/isaeken/laravel-translator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/isaeken/laravel-translator/run-tests?label=tests)](https://github.com/isaeken/laravel-translator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/isaeken/laravel-translator/Check%20&%20fix%20styling?label=code%20style)](https://github.com/isaeken/laravel-translator/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/isaeken/laravel-translator.svg?style=flat-square)](https://packagist.org/packages/isaeken/laravel-translator)

## Installation

You can install the package via composer:

```bash
composer require isaeken/laravel-translator
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="IsaEken\LaravelTranslator\LaravelTranslatorServiceProvider" --tag="laravel-translator-config"
```

This is the contents of the published config file:

```php
return [
    'supported_languages' => [
        'en' => 'English',
    ],

    'abort_if_unsupported' => false,
];
```

## Usage

```php
__('Hello World'); // Save to your fallback language file in not production environment.
```

See ``/api/translator/?locale=tr``

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Isa Eken](https://github.com/isaeken)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
