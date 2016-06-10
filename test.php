<?php

require_once('ItemsContainer.php');

// case 1
$t1 = new ItemsContainer();
$t1->items->someMethod(); // OK
foreach ($t1->items as $item) {
    $item->someMethod(); // OK
}

// case 2
$t2 = new ItemsContainer();
$t2->items[] = new SomeItem();
$t2->items->someMethod(); // IDE warning: Method someMethod not found in array
foreach ($t2->items as $item) {
    $item->someMethod(); // No IDE warning, but no autocomplete :(
}

// case 3
$t3 = new ItemsContainer();
$t3->items->someMethod(); // OK
$t3->items[] = new SomeItem();
$t3->items->someMethod(); // OK
foreach ($t3->items as $item) {
    $item->someMethod();  // OK
}

// case 4
$t4 = new ItemsContainer();
$t4->items['someKey'] = new SomeItem();
$t4->items->someMethod(); // OK
foreach ($t4->items as $item) {
    $item->someMethod(); // OK
}
