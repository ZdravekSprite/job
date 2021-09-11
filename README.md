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
## day model (+ factory + migration + seeder + controller)
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
      $table->time('night')->default('00:00:00');
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
    'end' => 'datetime:H:i',
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
```
### routes\web.php
```php
use App\Http\Controllers\DayController;

Route::resource('days', DayController::class)->middleware(['auth']);
```
### app\Http\Controllers\DayController.php
```php
use Illuminate\Support\Facades\Auth;

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $days = Day::orderBy('date','desc')->where('user_id', '=', Auth::user()->id)->get();
    return view('days.index')->with('days', $days);
  }
```
```bash
git add .
git commit -am "Day 04"
```
## holiday model (+ factory + migration + seeder + controller)
```bash
php artisan make:model Holiday -a
```
### database\migrations\2021_09_05_092658_create_holidays_table.php
```php
  public function up()
  {
    Schema::create('holidays', function (Blueprint $table) {
      $table->id();
      $table->date('date')->unique();
      $table->string('name');
      $table->timestamps();
    });
  }
```
### app\Models\Holiday.php
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
  ];
```
### database\seeders\HolidaySeeder.php
```php
use App\Models\Holiday;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

public function run()
  {
    DB::table('holidays')->delete();

    $holidays = [
      ['date' => date('Y-m-d', strtotime('1.1.2020')), 'name' => 'Nova godina'],
      ['date' => date('Y-m-d', strtotime('6.1.2020')), 'name' => 'Sveta tri kralja (Bogojavljenje)'],
      ['date' => date('Y-m-d', strtotime('12.4.2020')), 'name' => 'Uskrs'],
      ['date' => date('Y-m-d', strtotime('13.4.2020')), 'name' => 'Uskrsni ponedjeljak'],
      ['date' => date('Y-m-d', strtotime('1.5.2020')), 'name' => 'Praznik rada'],
      ['date' => date('Y-m-d', strtotime('30.5.2020')), 'name' => 'Dan državnosti'],
      ['date' => date('Y-m-d', strtotime('11.6.2020')), 'name' => 'Tijelovo'],
      ['date' => date('Y-m-d', strtotime('22.6.2020')), 'name' => 'Dan antifašističke borbe'],
      ['date' => date('Y-m-d', strtotime('5.8.2020')), 'name' => 'Dan pobjede i domovinske zahvalnosti i Dan hrvatskih branitelja'],
      ['date' => date('Y-m-d', strtotime('15.8.2020')), 'name' => 'Velika Gospa'],
      ['date' => date('Y-m-d', strtotime('1.11.2020')), 'name' => 'Dan svih svetih'],
      ['date' => date('Y-m-d', strtotime('18.11.2020')), 'name' => 'Dan sjećanja na žrtve Domovinskog rata i Dan sjećanja na žrtvu Vukovara i Škabrnje'],
      ['date' => date('Y-m-d', strtotime('25.12.2020')), 'name' => 'Božić'],
      ['date' => date('Y-m-d', strtotime('26.12.2020')), 'name' => 'Sveti Stjepan'],
      ['date' => date('Y-m-d', strtotime('1.1.2021')), 'name' => 'Nova godina'],
      ['date' => date('Y-m-d', strtotime('6.1.2021')), 'name' => 'Sveta tri kralja (Bogojavljenje)'],
      ['date' => date('Y-m-d', strtotime('4.4.2021')), 'name' => 'Uskrs'],
      ['date' => date('Y-m-d', strtotime('5.4.2021')), 'name' => 'Uskrsni ponedjeljak'],
      ['date' => date('Y-m-d', strtotime('1.5.2021')), 'name' => 'Praznik rada'],
      ['date' => date('Y-m-d', strtotime('30.5.2021')), 'name' => 'Dan državnosti'],
      ['date' => date('Y-m-d', strtotime('3.6.2021')), 'name' => 'Tijelovo'],
      ['date' => date('Y-m-d', strtotime('22.6.2021')), 'name' => 'Dan antifašističke borbe'],
      ['date' => date('Y-m-d', strtotime('5.8.2021')), 'name' => 'Dan pobjede i domovinske zahvalnosti i Dan hrvatskih branitelja'],
      ['date' => date('Y-m-d', strtotime('15.8.2021')), 'name' => 'Velika Gospa'],
      ['date' => date('Y-m-d', strtotime('1.11.2021')), 'name' => 'Dan svih svetih'],
      ['date' => date('Y-m-d', strtotime('18.11.2021')), 'name' => 'Dan sjećanja na žrtve Domovinskog rata i Dan sjećanja na žrtvu Vukovara i Škabrnje'],
      ['date' => date('Y-m-d', strtotime('25.12.2021')), 'name' => 'Božić'],
      ['date' => date('Y-m-d', strtotime('26.12.2021')), 'name' => 'Sveti Stjepan'],
    ];

    Holiday::insert($holidays);
  }
```
### database\seeders\DatabaseSeeder.php
```php
    $this->call([
      HolidaySeeder::class,
    ]);
```
```bash
php artisan migrate:fresh --seed
```
### routes\web.php
```php
use App\Http\Controllers\HolidayController;
Route::resource('holidays', HolidayController::class);
```
### app\Http\Controllers\HolidayController.php
```php
  public function index()
  {
    $holidays = Holiday::orderBy('date', 'desc')->get();
    return view('holidays.index')->with('holidays', $holidays);
  }
```
```bash
git add .
git commit -am "Holidays 05"
```
## month model (+ factory + migration + seeder + controller)
```bash
php artisan make:model Month -a
```
### database\migrations\2021_09_05_165054_create_months_table.php
```php
  public function up()
  {
    Schema::create('months', function (Blueprint $table) {
      $table->id();
      $table->smallInteger('month');
      $table->unsignedBigInteger('user_id');
      $table->mediumInteger('bruto')->nullable();
      $table->mediumInteger('prijevoz')->nullable();
      $table->mediumInteger('odbitak')->nullable();
      $table->smallInteger('prirez')->nullable();
      $table->tinyInteger('prekovremeni')->nullable();
      $table->mediumInteger('stimulacija')->nullable();
      $table->mediumInteger('regres')->nullable(); 
      $table->timestamps();
      $table->unique(['user_id', 'month']);
      $table->foreign('user_id')->references('id')->on('users');
    });
  }
```
```bash
php artisan migrate
```
## Eloquent: Relationships

### app\Models\User.php
```php
  /**
   * Get the users months.
   */
  public function months()
  {
    return $this->hasMany(Month::class);
  }
```
### app\Models\Month.php
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
   * Get the user that owns the day.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
```
```bash
git add .
git commit -am "Month 01"
```
### routes\web.php
```php
use App\Http\Controllers\MonthController;

Route::resource('months', MonthController::class)->middleware(['auth']);
```
### app\Http\Controllers\MonthController.php
```php
use Illuminate\Support\Facades\Auth;

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $months = Month::orderBy('month','desc')->where('user_id', '=', Auth::user()->id)->get();
    return view('months.index')->with('months', $months);
  }
```
```bash
git add .
git commit -am "Month 08"
git push
```
