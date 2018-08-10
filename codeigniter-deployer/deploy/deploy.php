<?php
/**
 * Part of CodeIgniter Deployer
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/codeigniter-deployer
 */

require 'recipe/codeigniter.php';

// Your production server
server('prod', 'your.server.example.com', 22)
    ->user('username')
    ->forwardAgent()
    ->stage('production')
    ->env('branch', 'master')
    ->env('deploy_path', '/var/www/your-codeigniter-app');

// Your Git repository
set('repository', 'git@github.com:org/your-codeigniter-app.git');

//task('deploy:vendors-dev', function () {
//    if (commandExist('composer')) {
//        $composer = 'composer';
//    } else {
//        run("cd {{release_path}} && curl -sS https://getcomposer.org/installer | php");
//        $composer = 'php composer.phar';
//    }
//
//    run("cd {{release_path}} && $composer install --verbose --prefer-dist --no-progress --no-interaction");
//})->desc('Installing vendors including require-dev');

//task('deploy:phpunit', function () {
//    try {
//        run("cd {{release_path}}/application/tests && php ../../vendor/bin/phpunit");
//    } catch (\RuntimeException $e) {
//        // test fails
//        run("cd {{deploy_path}} && if [ ! -d releases-failed ]; then mkdir releases-failed; fi");
//        run("mv {{release_path}} {{deploy_path}}/releases-failed");
//        run("cd {{deploy_path}} && if [ -h release ]; then rm release; fi");
//
//        throw $e;
//    }
//})->desc('Run PHPUnit');

//task('deploy:security-checker', function () {
//     run("cd {{release_path}} && vendor/bin/security-checker security:check composer.lock");
//})->desc('Run SensioLabs Security Checker');

task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
//    'deploy:vendors-dev',
//    'deploy:phpunit',
//    'deploy:security-checker',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:symlink',
    'cleanup',
])->desc('Deploy your project');
