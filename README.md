# Laravel Translator

![Laravel Translator](https://banners.beyondco.de/Laravel%20Translator.png?theme=light&packageManager=composer%20require&packageName=isaeken/laravel-translator&pattern=architect&style=style_1&md=1&showWatermark=1&fontSize=100px&images=https://laravel.com/img/logomark.min.svg)

[![Latest Version](https://img.shields.io/github/v/tag/isaeken/laravel-translator?sort=semver&label=version)](https://packagist.org/packages/isaeken/laravel-translator)
![CircleCI](https://img.shields.io/circleci/build/github/isaeken/laravel-translator)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/isaeken/laravel-translator/Check%20&%20fix%20styling?label=code%20style)](https://github.com/isaeken/laravel-translator/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/isaeken/laravel-translator.svg?style=flat-square)](https://packagist.org/packages/isaeken/laravel-translator)

## Installation and setup

### Installation

You can install the package via composer:

```bash
composer require isaeken/laravel-translator
```

### Setup

You can publish the config file with:

```bash
php artisan vendor:publish --provider="IsaEken\LaravelTranslator\LaravelTranslatorServiceProvider" --tag="laravel-translator-config"
```

## Usage

You can activate auto save translation

````php
// config/translator.php
'autosave' => true
````

You can use the translation system as in Laravel standards.

````php
__('Hello :var', ['var' => 'World']); // save to your fallback file when auto save enabled.
````

You can use the translation system with javascript by adding the "@translator" directive to the head in your design.

````html
<head>
    @translator
    <script src="..."></script>
</head>
````

````javascript
__('Hello');
__('Hello :var', {'var': 'World'});
````

> Automatic recording or errors will not work in the translations you use on Javascript.

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
