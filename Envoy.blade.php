@servers(['web' => ['root@192.168.10.24']])

@task('deploy', ['on' => 'web', 'confirm' => true])
    cd /var/www/html/dainsys
    git checkout prod
    git pull origin prod
    composer install --no-dev
    php artisan migrate --force
    php artisan optimize
@endtask