# Happyr CloudFlare bundle

This Symfony2 bundle lets you talk to the CloudFlare client API

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

# Usage

``` php

    $cloudFlare=$this->container->get('happyr.clourflare.service.cloudflare');
    $cloudFlare->api('zone_file_purge', array('z'=>'my-domain.com', 'url'=>'http://my-domain.com/static/style.css'));

```
