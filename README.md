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

1-Clone the project to your htdocs directory
2-Configure the Database(application/config/database.php)
3-Configure the config file(application/config/config.php)

## Configuration
Email configuration : 
-Configure the email configuration file(application/config/email.php) for the forgotten password and validating register with the email


