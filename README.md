# Happyr CloudFlare bundle

This Symfony2 bundle lets you talk to the CloudFlare client API. For API reference please visit the [CloudFlare website](https://www.cloudflare.com/docs/client-api.html).

# Installation and Configuration

Install it like any other bundle with composer:

```
composer require happyr/cloud-flare-bundle
```

Once install and activated in the AppKernel.php you have to add your CloudFlare email and token in the configuration.

``` yaml
# app/config/config.yml

happyr_cloud_flare:
  email: tobias@happyr.com
  token: abcdefghijklmnop

```

# Usage example

Here below is an example how you clear the cache for the `http://my-domain.com/static/style.css` url.

``` php

$cloudFlare=$this->container->get('happyr.cloudflare.service.cloudflare');
$cloudFlare->api('zone_file_purge', array('z'=>'my-domain.com', 'url'=>'http://my-domain.com/static/style.css'));

```
