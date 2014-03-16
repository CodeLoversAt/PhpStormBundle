PhpStormBundle
==============

Symfony bundle that assists you in updating your PhpStorm project config file.

## Important notice
**This bundle is in a very early stage and has ony been tested with PhpStorm 7 so far.** So before using it with any older version, make sure you backup your `.idea` folder.

## Installation

Install the bundle using composer (see [http://getcomposer.org/](http://getcomposer.org/) for more information about composer) by adding it to your `composer.json` file and running `composer update`:

```JavaScript
    // composer.json

    "require": {
        // ...
        "codelovers/phpstorm-bundle": "dev-master"
    }
```

Then just add the bundle to your `AppKernel.php` file:

```PHP
<?php
// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new CodeLovers\PhpStormBundle\CodeLoversPhpStormBundle(),
    // ...
);
```

## Usage

Currently there's only one command installed which will update your template data language config according to your configuration.

### Configuration

In a typical environment you will only need to configure your `template_data_languages`.

```YAML
code_lovers_php_storm:
    template_data_languages:
        - { pattern: "*.js.twig", dialect: "JavaScript" }
        - { pattern: "*.css.twig", dialect: "CSS" }
        - { pattern: "*.less.twig", dialect: "LESS" }

```

Additionally you can configure the path to your `.idea` folder and multiple source folders to process. Following are the default values:

```YAML
code_lovers_php_storm:
    config_folder:  "%kernel.root_dir%/../.idea"
    source_folders:
        - "%kernel.root_dir%/../src"
```

### Update template data languages

Simply execute the command `codelovers:phpstorm:processTemplates`.

```
php app/console codelovers:phpstorm:processTemplates
```

If PhpStorm has been running, restart it, so it reloads the project configuration.
