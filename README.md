```bash
composer create-project --prefer-dist laravel/laravel job
cd job
```
### .gitignore
```
composer.lock
package-lock.json
```
### .editorconfig
```
end_of_line = crlf
indent_size = 2
```
## MySql
> - create laravel_job db
### .env
```
APP_NAME="Laravel Job"
DB_DATABASE=laravel_job
APP_URL=https://laravel.test.com
```
```bash
npm install && npm run dev
php artisan migrate:fresh
git init
git add .
git commit -am "Initial Commit - Laravel Framework Installed"
git remote add origin https://github.com/ZdravekSprite/job.git
git branch -M main
git push -u origin main
```
## Laravel Breeze
```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate:fresh
git add .
git commit -am "Laravel Breeze Installed"
git push
```
### routes\web.php
```
Route::get('/', function () {
    return view('welcome');
})->name('home');
```
## app\Providers\AppServiceProvider.php
```php
use Illuminate\Support\Facades\URL;
public function boot()
  {
    URL::forceScheme('https');
  }
```
```bash
git commit -am "Laravel Breeze - fix"
git push
```