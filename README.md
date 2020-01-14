# CI Test Tools

## Installation

```bash
composer require --dev elbgoods/ci-test-tools
yarn add --dev elbgoods/ci-test-tools
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
