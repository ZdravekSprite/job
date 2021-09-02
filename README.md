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
### app\Providers\AppServiceProvider.php
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
### database\seeders\DatabaseSeeder.php
```php
use Illuminate\Support\Facades\Hash;
use App\Models\User;

  public function run()
  {
    User::factory()
      ->create([
        'name' => env('ADMIN_NAME', 'admin'),
        'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
        'password' => Hash::make(env('ADMIN_PASS', 'password')),
      ]);
  }
```
### .env
```
ADMIN_NAME=admin
ADMIN_EMAIL=admin@admin.com
ADMIN_PASS=password1234
```
## day model (+ migration + controller)
```bash
php artisan make:model Day -a
```
### database\migrations\2021_09_02_095846_create_days_table.php
```php
  public function up()
  {
    Schema::create('days', function (Blueprint $table) {
      $table->id();
      $table->date('date');
      $table->unsignedBigInteger('user_id');
      $table->tinyInteger('state')->default(0);
      $table->time('start')->default('00:00:00');
      $table->time('end')->default('00:00:00');
      $table->timestamps();
      $table->unique(['user_id', 'date']);
      $table->foreign('user_id')->references('id')->on('users');
    });
  }
```
```bash
php artisan migrate:fresh --seed
```
## Eloquent: Relationships

### app\Models\User.php
```php
  /**
   * Get the users days.
   */
  public function days()
  {
    return $this->hasMany(Day::class);
  }
```
### app\Models\Day.php
```php
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id',
    'created_at',
    'updated_at',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'date' => 'datetime:d.m.Y',
    'start' => 'datetime:H:i',
    'duration' => 'datetime:H:i',
  ];

  /**
   * Get the user that owns the day.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
```
```bash
git add .
git commit -am "Day 01"
git push
```
