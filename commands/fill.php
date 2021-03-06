<?php
use App\Connection;

require dirname(__DIR__). '/vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

$pdo = Connection::getPDO();

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

// creation du user
$password = password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET username='admin',password='$password'");

for ($i=1;$i < 51; $i++){
    $pdo->exec("INSERT INTO post SET title='{$faker->sentence()}', slug_post='{$faker->slug}', content='{$faker->paragraph(rand(3,15), true)}', created_at='{$faker->date} {$faker->time}', id_user = 1 ");
    $posts[] = $pdo->lastInsertId();
}
for ($i=1;$i < 6; $i++){
    $pdo->exec("INSERT INTO category SET name_category='{$faker->sentence(3)}', slug_category='{$faker->slug}'");
    $categories[] = $pdo->lastInsertId();
}
foreach($posts as $post) {

    $randomCategories = $faker->randomElements($categories, rand(0, count($categories)));
    foreach($randomCategories as $category) {
        $pdo->exec("INSERT INTO post_category SET id_post=$post, id_category=$category");

    }

}