<?php

use ArrQ\ArrQ;

$inputArrayOfItems = [
    [ 'name' => 'Nikos', 'grade' => 18 ],
    [ 'name' => 'Alex', 'grade' => 20 ],
    [ 'name' => 'Stavros', 'grade' => 19 ],
];

test('sort array of items by number asc', function () use ($inputArrayOfItems) {
    $arrQ = new ArrQ($inputArrayOfItems);
    $arrQ->sortByKey('grade', 'ASC');
    $expectedResult = [
        [ 'name' => 'Nikos', 'grade' => 18 ],
        [ 'name' => 'Stavros', 'grade' => 19 ],
        [ 'name' => 'Alex', 'grade' => 20 ],
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('sort array of items by number desc', function () use ($inputArrayOfItems) {
    $arrQ = new ArrQ($inputArrayOfItems);
    $arrQ->sortByKey('grade', 'DESC');
    $expectedResult = [
        [ 'name' => 'Alex', 'grade' => 20 ],
        [ 'name' => 'Stavros', 'grade' => 19 ],
        [ 'name' => 'Nikos', 'grade' => 18 ],
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('sort array of items by string asc', function () use ($inputArrayOfItems) {
    $arrQ = new ArrQ($inputArrayOfItems);
    $arrQ->sortByKey('name', 'ASC');
    $expectedResult = [
        [ 'name' => 'Alex', 'grade' => 20 ],
        [ 'name' => 'Nikos', 'grade' => 18 ],
        [ 'name' => 'Stavros', 'grade' => 19 ],  
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('sort array of items by string desc', function () use ($inputArrayOfItems) {
    $arrQ = new ArrQ($inputArrayOfItems);
    $arrQ->sortByKey('name', 'DESC');
    $expectedResult = [
        [ 'name' => 'Stavros', 'grade' => 19 ],
        [ 'name' => 'Nikos', 'grade' => 18 ],
        [ 'name' => 'Alex', 'grade' => 20 ],
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('key is not an array key', function () use ($inputArrayOfItems) {
    expect(fn() => (new ArrQ($inputArrayOfItems))->sortByKey('unknown', 'DESC'))->toThrow(\InvalidArgumentException::class, "Given key was not found as array key.");
});

test('filter items whose property has specific value', function () use ($inputArrayOfItems) {
    $arrQ = (new ArrQ($inputArrayOfItems))->where('name', 'Alex', '=');
    $expectedResult = [
        [ 'name' => 'Alex', 'grade' => 20 ],
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('filter items whose property has greater or equal value', function () use ($inputArrayOfItems) {
    $arrQ = (new ArrQ($inputArrayOfItems))->where('grade', '19', '>=');
    $expectedResult = [
        [ 'name' => 'Alex', 'grade' => 20 ],
        [ 'name' => 'Stavros', 'grade' => 19 ],
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});


class TestStudentGrade {
    /**
     * @var string $name
     */
    public $name;

    /**
     * @var int $grade
     */
    public $grade;

    /**
     * @param string $name
     * @param int $grade
     */
    public function __construct($name, $grade)
    {
        $this->name = $name;
        $this->grade = $grade;
    }
}

$inputArrayOfObjects = [
    new TestStudentGrade('Nikos', 18),
    new TestStudentGrade('Alex', 20),
    new TestStudentGrade('Stavros', 19),
];

test('sort array of objects by number asc', function () use ($inputArrayOfObjects) {
    $arrQ = new ArrQ($inputArrayOfObjects);
    $arrQ->sortByKey('grade', 'ASC');
    $expectedResult = [
        new TestStudentGrade('Nikos', 18),
        new TestStudentGrade('Stavros', 19),
        new TestStudentGrade('Alex', 20),
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('sort array of objects by number desc', function () use ($inputArrayOfObjects) {
    $arrQ = new ArrQ($inputArrayOfObjects);
    $arrQ->sortByKey('grade', 'DESC');
    $expectedResult = [
        new TestStudentGrade('Alex', 20),
        new TestStudentGrade('Stavros', 19),
        new TestStudentGrade('Nikos', 18),
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('sort array of objects by string asc', function () use ($inputArrayOfObjects) {
    $arrQ = new ArrQ($inputArrayOfObjects);
    $arrQ->sortByKey('name', 'ASC');
    $expectedResult = [
        new TestStudentGrade('Alex', 20),
        new TestStudentGrade('Nikos', 18),
        new TestStudentGrade('Stavros', 19),
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('sort array of objects by string desc', function () use ($inputArrayOfObjects) {
    $arrQ = new ArrQ($inputArrayOfObjects);
    $arrQ->sortByKey('name', 'DESC');
    $expectedResult = [
        new TestStudentGrade('Stavros', 19),
        new TestStudentGrade('Nikos', 18),
        new TestStudentGrade('Alex', 20),
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('key not found as object property', function () use ($inputArrayOfObjects) {
    expect(fn() => (new ArrQ($inputArrayOfObjects))->sortByKey('unknown', 'DESC'))->toThrow(\InvalidArgumentException::class, "Given key was not found as object property.");
});

test('filter objects whose property has specific value', function () use ($inputArrayOfObjects) {
    $arrQ = (new ArrQ($inputArrayOfObjects))->where('name', 'Alex', '=');
    $expectedResult = [
        new TestStudentGrade('Alex', 20),
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

test('filter objects whose property has greater or equal value', function () use ($inputArrayOfObjects) {
    $arrQ = (new ArrQ($inputArrayOfObjects))->where('grade', '19', '>=');
    $expectedResult = [
        new TestStudentGrade('Alex', 20),
        new TestStudentGrade('Stavros', 19),
    ];
    expect($arrQ->getQueryArray())->toMatchArray($expectedResult);
});

$inputArrayOfDuplicatedItems = [
    new TestStudentGrade('Nikos', 17),
    new TestStudentGrade('Nikos', 17),
    new TestStudentGrade('Alex', 20),
    new TestStudentGrade('Stavros', 19),
    new TestStudentGrade('Stavros', 19)
];

test('remove duplicate items', function () use ($inputArrayOfDuplicatedItems) {
    $expectedResult = [
        new TestStudentGrade('Nikos', 17),
        new TestStudentGrade('Alex', 20),
        new TestStudentGrade('Stavros', 19),
    ];
    expect((new ArrQ($inputArrayOfDuplicatedItems))->distinct())->toMatchArray($expectedResult);
});