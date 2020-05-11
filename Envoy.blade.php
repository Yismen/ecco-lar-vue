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

<<<<<<< HEAD
@task('create_release', ['on' => 'web2'])    
    cp -rvfp {{ $projectFolder }} {{ $releaseFolder }}
    sudo chmod -R 775 {{ $releaseFolder.'/storage' }}
    php artisan optimize
=======
@task('serve', ['on' => 'web2'])    
    {{-- 1: Make sure the link is poiting to production folder --}}
    ln -sfn {{ $projectFolder }} {{ $serverLink }}
    {{-- 2: Create release folder a bulk production content in it --}}
    [ -d {{ $releaseFolder }} ] || mkdir {{ $releaseFolder }}
    cp -rvfp {{ $projectFolder . "/*" }} {{ $releaseFolder }}
    {{-- chmod -R 775 {{ $releaseFolder.'/storage' }}
    chmod -R 775 {{ $releaseFolder.'/bootstrap/cache' }}
    chown -R :www-data {{ $releaseFolder }}
    chown -R :www-data {{ $serverLink }} --}}
    {{-- 3: Make the symlink point to the release folder --}}
>>>>>>> master
    ln -sfn {{ $releaseFolder }} {{ $serverLink }}
    {{-- 4: CD into production folder and update git, composer and NPM --}}
    cd {{ $projectFolder }}
    git checkout {{ $branch }}
    git pull origin {{ $branch }} --force
    composer install --no-dev -o -n
    php artisan migrate --force
    npm install
    npm run production
    php artisan dainsys:laravel-logs laravel- --clear --keep=8
    php artisan optimize
    {{-- 5: Point link to production folder --}}
    ln -sfn {{ $projectFolder }} {{ $serverLink }}    
    {{-- chown -R :www-data {{ $projectFolder }} --}}
    {{-- chown -R :www-data {{ $serverLink }} --}}
@endtask