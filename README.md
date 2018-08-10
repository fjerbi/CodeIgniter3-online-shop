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

### Servers

~~~php
// Your production server
server('prod', 'your.server.example.com', 22)
    ->user('username')
    ->forwardAgent()
    ->stage('production')
    ->env('branch', 'master')
    ->env('deploy_path', '/var/www/your-codeigniter-app');
~~~

See https://github.com/deployphp/docs/blob/master/servers.md for details.

### Repository

~~~php
// Your Git repository
set('repository', 'git@github.com:org/your-codeigniter-app.git');
~~~

You need `git` command on your servers, and make sure you can `git clone` on the servers.

### Reference

* https://github.com/deployphp/docs

## Configure Your Servers

### Apache

See the sample below. In this case, `/var/www/your-codeigniter-app` is a base folder.

~~~
your-codeigniter-app/
├── current -> /var/www/your-codeigniter-app/releases/20150529181638
└── releases/
     ├── 20150529180505/
     ├── 20150529181203/
     └── 20150529181638/
~~~

Each deployment is installed in `releases/YYYYMMDDHHMMSS` folder.

The current release is `your-codeigniter-app/current` folder, and it is a symbolic link to `releases/20150529181638` folder.

So if you use [codeigniter-composer-installer](https://github.com/kenjis/codeigniter-composer-installer)'s folder structure, your Apache configuratoin is like this:

~~~
DocumentRoot /var/www/your-codeigniter-app/current/public
~~~

If you use CodeIgniter as the default folder structure, your Apache configuratoin is like this:

~~~
DocumentRoot /var/www/your-codeigniter-app/current
~~~

### sudo

Deployer will try to get write permission with the `sudo` command, so this command has to be running without prompt password and without tty.

Here is an example of configuration:

~~~
Defaults:username !requiretty

username   ALL=(ALL) NOPASSWD: /usr/bin/setfacl
~~~

If you don't need `sudo` for your deployment, you can set in `deploy/deployer.php`.

~~~php
set('writable_use_sudo', false);
~~~

## How to Deploy

~~~
$ cd /path/to/codeigniter/
$ cd deploy/
$ sh deploy.sh
~~~

## Related Projects for CodeIgniter 3.0

* [CodeIgniter Composer Installer](https://github.com/kenjis/codeigniter-composer-installer)
* [Cli for CodeIgniter 3.0](https://github.com/kenjis/codeigniter-cli)
* [CI PHPUnit Test](https://github.com/kenjis/ci-phpunit-test)
* [CodeIgniter Simple and Secure Twig](https://github.com/kenjis/codeigniter-ss-twig)
* [CodeIgniter Doctrine](https://github.com/kenjis/codeigniter-doctrine)
