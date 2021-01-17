<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'online-rating');

// Project repository
set('repository', 'git@github.com:ak-flash/online-rating.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

localhost()
    //->stage('production')
    ->set('deploy_path', '/www/wwwroot/online-rating.ak-vps.tk');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('publish:livewire', 'php artisan vendor:publish --force --tag=livewire:assets');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
after('deploy:unlock', 'publish:livewire');
// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

