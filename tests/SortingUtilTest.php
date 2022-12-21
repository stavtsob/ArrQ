<?php

use ArrQ\Utils\SortingUtil;

$inputArrayOfItems = [
    [ 'name' => 'Nikos', 'age' => 18 ],
    [ 'name' => 'Alex', 'age' => 36 ],
    [ 'name' => 'Stavros', 'age' => 27 ],
];

test('sort array of items by number asc', function () use ($inputArrayOfItems) {
    $expectedResult = [
        [ 'name' => 'Nikos', 'age' => 18 ],
        [ 'name' => 'Stavros', 'age' => 27 ],
        [ 'name' => 'Alex', 'age' => 36 ],
    ];
    expect(SortingUtil::sortArrayOfItems($inputArrayOfItems, 'age'))->toMatchArray($expectedResult);
});

test('sort array of items by number desc', function () use ($inputArrayOfItems) {
    $expectedResult = [
        [ 'name' => 'Alex', 'age' => 36 ],
        [ 'name' => 'Stavros', 'age' => 27 ],
        [ 'name' => 'Nikos', 'age' => 18 ],
    ];
    expect(SortingUtil::sortArrayOfItems($inputArrayOfItems, 'age', 'DESC'))->toMatchArray($expectedResult);
});

test('sort array of items by string asc', function () use ($inputArrayOfItems) {
    $expectedResult = [
        [ 'name' => 'Alex', 'age' => 36 ],
        [ 'name' => 'Nikos', 'age' => 18 ],
        [ 'name' => 'Stavros', 'age' => 27 ],  
    ];
    expect(SortingUtil::sortArrayOfItems($inputArrayOfItems, 'name'))->toMatchArray($expectedResult);
});

test('sort array of items by string desc', function () use ($inputArrayOfItems) {
    $expectedResult = [
        [ 'name' => 'Stavros', 'age' => 27 ],
        [ 'name' => 'Nikos', 'age' => 18 ],
        [ 'name' => 'Alex', 'age' => 36 ],
    ];
    expect(SortingUtil::sortArrayOfItems($inputArrayOfItems, 'name', 'DESC'))->toMatchArray($expectedResult);
});


class TestPerson {
    /**
     * @var string $name
     */
    public $name;

    /**
     * @var int $age
     */
    public int $age;

    /**
     * @param string $name
     * @param int $age
     */
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
}

$inputArrayOfObjects = [
    new TestPerson('Nikos', 18),
    new TestPerson('Alex', 36),
    new TestPerson('Stavros', 27),
];

test('sort array of objects by number asc', function () use ($inputArrayOfObjects) {
    $expectedResult = [
        new TestPerson('Nikos', 18),
        new TestPerson('Stavros', 27),
        new TestPerson('Alex', 36),
    ];
    expect(SortingUtil::sortArrayOfObjects($inputArrayOfObjects, 'age'))->toMatchArray($expectedResult);
});

test('sort array of objects by number desc', function () use ($inputArrayOfObjects) {
    $expectedResult = [
        new TestPerson('Alex', 36),
        new TestPerson('Stavros', 27),
        new TestPerson('Nikos', 18),
    ];
    expect(SortingUtil::sortArrayOfObjects($inputArrayOfObjects, 'age', 'DESC'))->toMatchArray($expectedResult);
});

test('sort array of objects by string asc', function () use ($inputArrayOfObjects) {
    $expectedResult = [
        new TestPerson('Alex', 36),
        new TestPerson('Nikos', 18),
        new TestPerson('Stavros', 27),
    ];
    expect(SortingUtil::sortArrayOfObjects($inputArrayOfObjects, 'name'))->toMatchArray($expectedResult);
});

test('sort array of objects by string desc', function () use ($inputArrayOfObjects) {
    $expectedResult = [
        new TestPerson('Stavros', 27),
        new TestPerson('Nikos', 18),
        new TestPerson('Alex', 36),
    ];
    expect(SortingUtil::sortArrayOfObjects($inputArrayOfObjects, 'name', 'DESC'))->toMatchArray($expectedResult);
});