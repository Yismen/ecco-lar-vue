@servers(['local' => ['127.0.0.1'], 'web' => ['root@192.168.10.24']])

@story('deploy')
    checkout
    merge
    push
    cmaster
    serve
@endstory

@task('checkout', ['on' => 'local'])
    git checkout prod
@endtask
@task('merge', ['on' => 'local'])
    git merge master
@endtask
@task('push', ['on' => 'local'])
    git push origin prod
@endtask
@task('cmaster', ['on' => 'local'])
    git checkout master
@endtask


@task('serve', ['on' => 'web'])
    cd /var/www/html/dainsys
    git checkout prod
    git pull origin prod
    composer install --no-dev
    php artisan migrate --force
    sudo php artisan optimize
    php artisan dainsys:laravel-logs laravel- --clear --keep=8
@endtask