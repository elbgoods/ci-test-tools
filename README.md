# CI Test Tools

[![Packagist](https://img.shields.io/packagist/l/elbgoods/ci-test-tools?style=flat-square)](https://packagist.org/packages/elbgoods/ci-test-tools)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/elbgoods/ci-test-tools?style=flat-square)](https://packagist.org/packages/elbgoods/ci-test-tools)
[![Packagist Version](https://img.shields.io/packagist/v/elbgoods/ci-test-tools?style=flat-square)](https://packagist.org/packages/elbgoods/ci-test-tools)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/elbgoods/ci-test-tools/run-tests?style=flat-square)](https://github.com/elbgoods/ci-test-tools/actions?query=workflow%3Arun-tests)

## Installation

```bash
composer require --dev bamarni/composer-bin-plugin elbgoods/ci-test-tools
```

## PHP

### PHP-CS-FIXER

* **tool:** https://github.com/FriendsOfPHP/PHP-CS-Fixer
* **config:** [configs/.php_cs.dist](configs/.php_cs.dist)

#### Installation

```bash
composer bin php-cs require --dev friendsofphp/php-cs-fixer
```

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

#### Installation

```bash
composer bin php-tlint require --dev tightenco/tlint
```

#### Usage

```bash
vendor/bin/php-tlint-test
```

#### Configuration

You have to create a `tlint.json` file on your project root level with the following, and only, content.

```json
{
    "preset": "laravel",
    "disabled": [
        "NoInlineVarDocs",
        "NoParensEmptyInstantiations"
    ]
}
```

### PHPMD

* **tool:** https://github.com/phpmd/phpmd
* **config:** [configs/phpmd.xml](configs/phpmd.xml)

#### Installation

```bash
composer bin php-md require --dev phpmd/phpmd
```

#### Usage

```bash
vendor/bin/php-md-test
```

### PHP Insights

* **tool:** https://github.com/nunomaduro/phpinsights
* **config:** [configs/phpinsights.php](configs/phpinsights.php)

#### Installation

```bash
composer bin php-insights require --dev nunomaduro/phpinsights
```

#### Usage

```bash
vendor/bin/php-insights-test
```

### PHPMND

* **tool:** https://github.com/povils/phpmnd

#### Installation

```bash
composer bin php-mn require --dev povils/phpmnd
```

#### Usage

```bash
vendor/bin/php-mn-test
```

### Larastan

* **tool:** https://github.com/nunomaduro/larastan
* **config:** [configs/phpstan.neon.dist](configs/phpstan.neon.dist)

#### Installation

```bash
composer bin php-stan require --dev nunomaduro/larastan
```

#### Usage

```bash
vendor/bin/php-stan-test
```

#### Configuration

You have to create a `phpstan.neon.dist` file on your project root level with the following content.

```neon
includes:
    - ./vendor-bin/php-stan/vendor/nunomaduro/larastan/extension.neon
    - ./vendor-bin/php-stan/vendor/elbgoods/ci-test-tools/configs/phpstan.neon.dist

parameters:
    paths:
        - ./app
        - ./config
        - ./routes
```
