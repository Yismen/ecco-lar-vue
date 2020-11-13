@servers(['local' => ['127.0.0.1'], 'web' => ['root@192.168.10.24'], 'web2' => ['yjorge@192.168.10.24']])

@setup
    $root = '/var/www/html/';
    $releaseFolder = $root .'release';
    $projectFolder = $root . 'dainsys';
    $serverLink = $root . 'current';
    $branch = 'master';
@endsetup

@task('deploy', ['on' => 'web2'])    
    ln -sfn {{ $projectFolder }} {{ $serverLink }}
    
    [ -d {{ $releaseFolder }} ] || mkdir {{ $releaseFolder }}
    cp -rvfp {{ $projectFolder . "/*" }} {{ $releaseFolder }}
    {{-- cp -rvfp {{ $projectFolder . "/.env" }} {{ $releaseFolder }} --}}
    {{-- chmod -R 775 {{ $releaseFolder.'/storage' }} --}}
    {{-- chmod -R 775 {{ $releaseFolder.'/bootstrap/cache' }} --}}

    {{-- cd {{ $releaseFolder }} --}}
    {{-- php artisan optimize --}}

    ln -sfn {{ $releaseFolder }} {{ $serverLink }}
    
    cd {{ $projectFolder }}
    git reset --hard
    git checkout {{ $branch }}
    git pull origin {{ $branch }} --force
    composer install --no-dev -o -n
    php artisan migrate --force
    npm install
    npm run production
    php artisan dainsys:laravel-logs laravel- --clear --keep=8
    php artisan cache:clear
    php artisan optimize

    ln -sfn {{ $projectFolder }} {{ $serverLink }}
@endtask