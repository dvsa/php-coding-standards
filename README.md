# DVSA PHP Coding Standards
A custom ruleset for [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) and [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) for use in the Driver and Vehicles Standard Agency.
DVSA PHP Coding standards are maintained and updated by the developer community at the DVSA. 
See [CONTRIBUTING.md](/CONTRIBUTING.md) for more information how make changes.

## Prerequisites
- [Composer](https://getcomposer.org/)
- _at least_ PHP 7.4
- [Git](https://git-scm.com/)

## Installation
`composer require --dev dvsa/coding-standards`

or if you install the coding standard tools globally use:

`composer require global dvsa/coding-standards`

## How to set up
Refer to the [Integrations](#integrations) or [How to run](#how-to-run) section for help with running/integrating in with code editors/IDE.

### PHP CodeSniffer
Repository: https://github.com/squizlabs/PHP_CodeSniffer.

1. Create a `phpcs.dist.xml` file in the root directory of your project. Example:
   ```xml
   <?xml version="1.0"?>
   <ruleset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" name="DVSA" xsi:noNamespaceSchemaLocation="./vendor/squizlabs/php_codesniffer/phpcs.xsd">
     <file>./path/to/directory</file>
     <file>./path/to/file.php</file>

     <exclude-pattern>*/vendor/*</exclude-pattern>

     <rule ref="./vendor/dvsa/coding-standards/src/Profiles/DVSA/CS/ruleset.xml" />
   </ruleset>
   ```
[XML reference](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-Ruleset).

### PHP-CS-Fixer
Repository: https://github.com/FriendsOfPHP/PHP-CS-Fixer.

Due to the number of dependencies in `php-cs-fixer` it must be installed manually.

1. Recommended way to install using [composer-bin-plugin](https://github.com/bamarni/composer-bin-plugin).
   ```shell
   $ composer require --dev bamarni/composer-bin-plugin
   ```
3. Install `php-cs-fixer`. It is [recommended](https://github.com/FriendsOfPHP/PHP-CS-Fixer#installation) to install `PHP-CS-Fixer` in a separate working directory:
    ```shell 
    $ composer bin php-cs-fixer require friendsofphp/php-cs-fixer
    ```
4. Create a `.php-cs-fixer.dist.php` file in the root directory of your project.
5. Add `.php-cs-fixer.cache` to your `.gitignore`. The cache filename can be changed using the `$cacheFilename` parameter (default: `.php-cs-fixer.cache`).
6. Configure and return a `PhpCsFixer\ConfigInterface` object. This repository provides a preconfigured class:
    ```php
    <?php

    $finder = PhpCsFixer\Finder::create()
        ->exclude('vendor')
        ->in(__DIR__);

    // Any additional project rules/rule sets.
    $additionalRules = [
        // Rule sets
        '@PHP80Migration:risky' => true,
        '@PHP81Migration' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        // Individual rules
        'protected_to_private' => false,
    ];

    return new Dvsa\PhpCodingStandard\Config($finder, $additionalRules);
    ```

*Tip*: Add `.php-cs-fixer.php` to your `.gitignore` to enable additional rules locally.

## How to run
### GitHooks
Recommended using a tool to handle the GitHooks functionality due to the manual steps to set up hooks (symlinks/copying). Lots of tools can be used to handle GitHooks.

##### Husky & lint-staged (NPM)
Repositories: [Husky](https://github.com/typicode/husky) & [lint-staged](https://github.com/okonet/lint-staged) package.

1. Install using NPM:
```shell
$ npm i -D husky lint-staged
```
2. Create `.lintstagedrc`:
```json
{
   "**/*.php": [
      "php ./vendor/bin/phpcs -n -p --colors --report=diff",
      "php ./vendor/bin/php-cs-fixer fix --config .php-cs-fixer.dist.php"
   ]
}
```
3. Configure Husky: 
```shell
$ npm set-script prepare "husky install"
$ npm run prepare
```
4. Add `lint-staged` to the `pre-commit` hook:
```shell
npx husky add .husky/pre-commit "lint-staged"
```

## Integrations
### JetBrains (IntelliJ/PHPStorm)

### VSCode

## Licence 
See [LICENSE.md](/LICENSE.md)

## Contributing
See [CONTRIBUTING.md](/CONTRIBUTING.md)

## Acknowledgements
This coding standard is a tweak on top of the PSR2 standard 
and only possible becuase of that. 
However particularly the time and effort of Chris Emerson BJSS is acknowledged
for tidying this and working on it during his time on the VOL project. 
 


