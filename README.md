# CodeIgniter Deployer

[![Latest Stable Version](https://poser.pugx.org/kenjis/codeigniter-deployer/v/stable)](https://packagist.org/packages/kenjis/codeigniter-deployer) [![Total Downloads](https://poser.pugx.org/kenjis/codeigniter-deployer/downloads)](https://packagist.org/packages/kenjis/codeigniter-deployer) [![Latest Unstable Version](https://poser.pugx.org/kenjis/codeigniter-deployer/v/unstable)](https://packagist.org/packages/kenjis/codeigniter-deployer) [![License](https://poser.pugx.org/kenjis/codeigniter-deployer/license)](https://packagist.org/packages/kenjis/codeigniter-deployer)

A Deployment Tool for [CodeIgniter](https://github.com/bcit-ci/CodeIgniter) 3.0.

You can deploy CodeIgniter with one command.

This is based on [Deployer](http://deployer.org/) 3.0.

## Folder Structure

```
codeigniter/
└── deploy/
     ├── deploy.php ... config file for Deployer
     ├── deploy.sh  ... script to deploy
     └── logs/
```

## Requirements

* PHP 5.4.0 or later
* Composer
* Git
* SSH
* Shell

## Installation

Install this project with Composer:

~~~
$ cd /path/to/codeigniter/
$ composer require kenjis/codeigniter-deployer:1.0.x@dev --dev
~~~

Install `deploy` folder to your CodeIgniter application folder:

~~~
$ php vendor/kenjis/codeigniter-deployer/install.php
~~~

* Above command always overwrites exisiting files.
* You must run it at CodeIgniter project root folder.

## Configuration

Configure `deploy/deployer.php`.


