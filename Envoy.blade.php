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
    git pull origin prod --force
    composer install --no-dev -o -n
    php artisan migrate --force
    php artisan optimize
    npm install
    npm run production
    php artisan dainsys:laravel-logs laravel- --clear --keep=8
    supervisorctl reread
    supervisorctl update
    supervisorctl start laravel-worker:*
@endtask