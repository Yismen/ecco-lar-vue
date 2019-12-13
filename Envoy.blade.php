@servers(['web' => ['root@192.168.10.24']])

@task('deploy', ['on' => 'web'])
    cd /var/www/html/dainsys
    git pull origin prod
    composer install --no-dev
    php artisan migrate --force
    php artisan optimize
@endtask