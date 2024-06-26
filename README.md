<p align="center">
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 🤨 Apa Itu NutriMotion?
NutriMotion adalah sebuah terobosan revolusioner dalam mendukung gaya hidup sehat di era modern yang penuh dengan kesibukan. Dengan semakin meningkatnya kesadaran akan pentingnya nutrisi yang tepat, NutriMotion hadir sebagai sahabat setia yang membantu Anda menjaga keseimbangan nutrisi dengan mudah dan efektif.

## 🤓 Anggota Kelompok
- Fadel Mohammad Fadhilah (221511048)
- Mahesya Setia Nugraha (221511054)

## 💻 Clone Repository
### Clone Repository
```bash
https://github.com/mahesyasn18/be-nutrimotion.git
```
```bash
cd be-nutrimotion
```

### Install Composer Dependencies
```bash
composer install
```

### Create a copy of your .env File
```bash
cp .env.example .env
```

### Generate an app Encryption Key
```bash
php artisan key:generate
```

### Generate client key for passport
```bash
php artisan install:passport
```

### Open Project with VS Code
```bash
code .
```

### set Database on .env File
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YourDatabase
DB_USERNAME=YourUsernameDatabase
DB_PASSWORD=YourPasswordDatabase
```

### Finalizing The Installation
you should migrate your database
```bash
php artisan migrate --seed
```
```bash
php artisan storage:link
```

### Running Server
```bash
php artisan serve
```

## 📥 Push Repository
```bash
git add .
```
```bash
git commit -m "FEAT : Description"
```
Commit Information : 
- ADD (Copy and Paste File)
- INST (Install the package or technology needed)
- MAKE (Create migration files, seeders, controllers, models, and more)
- FEAT (Adding new features)
- FIX (Fixing bugs)
- DEL (Delete folder, file, or code)

```bash
git push -u origin branch-name
```

## 🔱 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

------------

<p align="center"><b>Made with ❤️ by AVL TREE Team Fadel and Mahesya</b></p>
