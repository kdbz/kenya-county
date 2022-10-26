# KenyaCounty

A laravel package that creates and seeds Kenya's :kenya: county,subcounty and wards lookup tables to a MySQL database.

## DB Structure
<p style="align:center">
    <img alt="DB Schema" src="https://github.com/kdbz/kenya-county/blob/main/schema.png" style="width:50%;">
</p>

## Installation

Use the package manager [composer](https://getcomposer.org/) to install KenyaCounty within your laravel project.

```bash
$ cd YOUR_LARAVEL_PROJECT_PATH

$ composer require kdbz/kenya-county
```

## Configuration

Publish the package configuration
```bash
$ php artisan vendor:publish --tag=kenyacounty-config
```

Publish the database migration files
```bash
$ php artisan vendor:publish --tag=kenyacounty-migrations
```

Publish the database seeder file
```bash
$ php artisan vendor:publish --tag=kenyacounty-seeders
```

## Usage
Migrate the database
```bash
$ php artisan migrate
```
Seed the database
```bash
$ php artisan db:seed --class=KenyaCountySeeder
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)