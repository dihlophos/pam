cd "$(dirname "$0")"
echo "Github pull:"
git pull
echo "<br/>DB migrate:"
php artisan migrate
echo "<br/>DB seed:"
php artisan db:seed
echo "<br/>Test run:"
./vendor/bin/phpunit --testdox-html ./public/testresults.html
echo "<br/>Test results: <a href='/testresults.html'>link</a>"