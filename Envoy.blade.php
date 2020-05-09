@servers(['local' => ['127.0.0.1'], 'web' => ['root@192.168.10.24'], 'web2' => ['yjorge@192.168.10.24']])

@setup
    $root = '/var/www/html/';
    $releaseFolder = $root .'release';
    $projectFolder = $root . 'dainsys';
    $serverLink = $root . 'current';
    $branch = 'prod';
@endsetup

@story('deploy')
    checkout
    merge
    push
    cmaster
    create_release
    serve
@endstory

@task('checkout', ['on' => 'local'])
    git checkout {{ $branch }}
@endtask
@task('merge', ['on' => 'local'])
    git merge master
@endtask
@task('push', ['on' => 'local'])
    git push origin {{ $branch }}
@endtask
@task('cmaster', ['on' => 'local'])
    git checkout master
@endtask

@task('create_release', ['on' => 'web2'])    
    cp -rvfp {{ $projectFolder }} {{ $releaseFolder }}
    sudo chmod -R 775 {{ $releaseFolder.'/storage' }}
    php artisan optimize
    ln -sfn {{ $releaseFolder }} {{ $serverLink }}
    
    {{-- chown -R :www-data {{ $releaseFolder }} --}}
    chown -R :www-data {{ $serverLink }}
@endtask

@task('serve', ['on' => 'web2'])  
    cd {{ $projectFolder }}
    git checkout {{ $branch }}
    {{-- git pull origin {{ $branch }} --force --}}
    composer install --no-dev -o -n
    php artisan migrate --force
    npm install
    npm run production
    php artisan dainsys:laravel-logs laravel- --clear --keep=8
    php artisan optimize
    ln -sfn {{ $projectFolder }} {{ $serverLink }}    
    {{-- chown -R :www-data {{ $projectFolder }} --}}
    chown -R :www-data {{ $serverLink }}
@endtask