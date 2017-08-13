<?php
namespace Deployer;

require 'recipe/common.php';

// Configuration

set('repository', 'https://github.com/maximAbdalov/phonebook.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
set('shared_files', []); // optional
set('shared_dirs', []); // optional
set('writable_dirs', []); // optional


// Hosts

host('production.phonebook.com')
    ->stage('production')
    ->set('deploy_path', '/var/www/phonebook.com');
    
host('test.phonebook.com')
    ->stage('test')
    ->set('deploy_path', '/var/www/test/phonebook.com');


// Tasks
desc('Migrate database');
task('migration', function () {
	run('vendor/bin/phinx migrate -e production');
})->onStage('production');

task('migration', function () {
	run('vendor/bin/phinx migrate -e test');
})->onStage('test');

desc('Deploy project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
	'migration',
    'cleanup',
    'success'
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');