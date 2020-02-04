# CI Test Tools

[![Packagist](https://img.shields.io/packagist/l/elbgoods/ci-test-tools?style=flat-square)](https://packagist.org/packages/elbgoods/ci-test-tools)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/elbgoods/ci-test-tools?style=flat-square)](https://packagist.org/packages/elbgoods/ci-test-tools)
[![Packagist Version](https://img.shields.io/packagist/v/elbgoods/ci-test-tools?style=flat-square)](https://packagist.org/packages/elbgoods/ci-test-tools)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/elbgoods/ci-test-tools/run-tests?style=flat-square)](https://github.com/elbgoods/ci-test-tools/actions?query=workflow%3Arun-tests)

## Installation

```bash
composer require --dev elbgoods/ci-test-tools
yarn add --dev elbgoods/ci-test-tools
```

If you experience a Memory Limit Error:
```bash
COMPOSER_MEMORY_LIMIT=-1 composer require --dev elbgoods/ci-test-tools
```

## PHP

### PHP-CS-FIXER

* **tool:** https://github.com/FriendsOfPHP/PHP-CS-Fixer
* **config:** [configs/.php_cs.dist](configs/.php_cs.dist)

#### Usage

```bash
vendor/bin/php-cs-test
vendor/bin/php-cs-fix
```

#### Configuration

If you want to adjust the default configuration you can use your `composer.json[extra]` section.

```json
{
  "extra": {
    "php-cs-fixer": {
      "finder": {
        "include": [],
        "exclude": []
      }
    } 
  }
}
```

### TLint

* **tool:** https://github.com/tightenco/tlint
* **config:** [src/TlintPreset.php](src/TlintPreset.php)

#### Usage

```bash
vendor/bin/php-tlint-test
```

#### Configuration

You have to create a `tlint.json` file on your project root level with the following, and only, content.

```json
{
    "preset": "\\Elbgoods\\CiTestTools\\TlintPreset"
}
```

### PHPMD

* **tool:** https://github.com/phpmd/phpmd
* **config:** [configs/phpmd.xml](configs/phpmd.xml)

#### Usage

```bash
vendor/bin/php-md-test
```

#### Configuration

If you think that a rule should be adjusted/ignored open a PR in [this repo](https://github.com/elbgoods/ci-test-tools) to discuss it.

### PHP Insights

* **tool:** https://github.com/nunomaduro/phpinsights
* **config:** [configs/phpinsights.php](configs/phpinsights.php)

#### Usage

```bash
vendor/bin/php-insights-test
```

#### Configuration

If you think that a rule should be adjusted/ignored open a PR in [this repo](https://github.com/elbgoods/ci-test-tools) to discuss it.

### Larastan

* **tool:** https://github.com/nunomaduro/larastan
* **config:** [configs/phpstan.neon.dist](configs/phpstan.neon.dist)

#### Usage

```bash
vendor/bin/php-stan-test
```

#### Configuration

You have to create a `phpstan.neon.dist` file on your project root level with the following content.

```neon
includes:
    - ./vendor/nunomaduro/larastan/extension.neon
    - ./vendor/elbgoods/ci-test-tools/configs/phpstan.neon.dist

parameters:
    paths:
        - ./app
        - ./config
        - ./routes
```
