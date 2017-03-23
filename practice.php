<?php

require "vendor/autoload.php";

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . DIRECTORY_SEPARATOR . "credentials.json");

$schema = (new GDS\Schema('Book'))
    ->addString('title')
    ->addString('author')
    ->addString('isbn');

$gdsOperation = new GDS\Store($schema, new \GDS\Gateway\RESTv1());

$book = $gdsOperation->createEntity([
    'title' => 'Life of a Programmer',
    'author' => 'Sharmin Shanta',
    'isbn' => '0000000',
    'published' => new DateTime('-1 day')
]);

//Insert a new book data
$gdsOperation->upsert($book);

/**
 * Fetch a single book
 */
$getBook = $gdsOperation->fetchOne("SELECT * FROM Book WHERE isbn = '0000000'");
echo $getBook->author;

//Delete that book
$gdsOperation->delete($getBook);
