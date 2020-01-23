# CI Test Tools

[![Packagist](https://img.shields.io/packagist/l/elbgoods/ci-test-tools?style=flat-square)](https://packagist.org/packages/elbgoods/ci-test-tools)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/elbgoods/ci-test-tools?style=flat-square)](https://packagist.org/packages/elbgoods/ci-test-tools)
[![Packagist Version](https://img.shields.io/packagist/v/elbgoods/ci-test-tools?style=flat-square)](https://packagist.org/packages/elbgoods/ci-test-tools)

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
