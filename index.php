<?php

use Task1\{First, Second};
use Task2\TestStrupa;
use Task5\Transctions;

define('ROOTPATH', __DIR__);

require_once 'vendor/autoload.php';

echo '-----------------task1---------------';
$firstObj = new First('A');
$secondObj = new Second('B');

echo "className first object {$firstObj->getClassName()}<br>";
echo "className second object {$secondObj->getClassName()}<br>";

echo "getMessage first object {$firstObj->getMessage()}<br>";
echo "getMessage second object {$secondObj->getMessage()}<br>";

echo '-----------------task2---------------';
$testStrupa = new TestStrupa([
    'red', 'blue', 'green', 'yellow', 'lime',
    'magenta', 'black', 'gold', 'gray', 'tomato'
]);

$arrColorsStrupa = $testStrupa->getColorWords(5, 5);

$col = 0;
for ($row = 1; $row <= 5; $row++) {
    for ($col; $col < 5 * $row; $col++) {
        echo "<span style='color:{$arrColorsStrupa[ $col]['color']}'>{$arrColorsStrupa[$col]['word']}</span>   ";
    }
    echo '<br>';
}


echo '-----------------task5---------------<br>';

$transaction = new Transctions();

echo '-----------------task5------query1-------------<br>';
echo "fullname   sum<br>";

foreach ($transaction->query1() as $person) {
    echo "{$person['fullname']}   {$person['sum']}<br>";
}

echo '-----------------task5------query2-------------<br>';
echo "city name<br>";

foreach ($transaction->query2() as $city) {
    echo "{$city['name']}<br>";
}


echo '-----------------task5------query3-------------<br>';
echo "transaction_id    from_person_id    to_person_id    amount    city_id<br>";

foreach ($transaction->query3() as $transaction) {
    echo "{$transaction['transaction_id']}    {$transaction['from_person_id']}    
        {$transaction['to_person_id']}   {$transaction['amount']}   {$transaction['city_id']}<br>";
}
