# minimalism-service-imgix

**minimalism-service-imgix** is a service for [minimalism](https://github.com/carlonicora/minimalism) to generate
[imgix](https://www.imgix.com/) links.

## Getting Started

To use this library, you need to have an application using minimalism. This library does not work outside this scope.

### Prerequisite

You should have read the [minimalism documentation](https://github.com/carlonicora/minimalism/readme.md) and understand
the concepts of services in the framework.

### Installing

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```
$ composer require carlonicora/minimalism-service-imgix
```

or simply add the requirement in `composer.json`

```json
{
    "require": {
        "carlonicora/minimalism-service-imgix": "~1.0"
    }
}
```

## Deployment

This service requires you to set up two parameters in your `.env` file in order to produce the imgix links.

### Required parameters

```dotenv
#the domain used as CDN
MINIMALISM_SERVICE_IMGIX_DOMAIN=
#your private sign key  
MINIMALISM_SERVICE_IMGIX_KEY= 
```

### Optional parameters

```dotenv
#default to 520
MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_HEIGTH=
MINIMALISM_SERVICE_IMGIX_DEFAULT_IMAGE_WIDTH=
```

## Build With

* [minimalism](https://github.com/carlonicora/minimalism) - minimal modular PHP MVC framework
* [imgix-php](https://github.com/imgix/imgix-php)

## Versioning

This project use [Semantiv Versioning](https://semver.org/) for its tags.

## Authors

* **Carlo Nicora** - Initial version - [GitHub](https://github.com/carlonicora) |
[phlow](https://phlow.com/@carlo)

# License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT) - see the
[LICENSE.md](LICENSE.md) file for details 

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)