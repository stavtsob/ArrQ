<?php

use ArrQ\Utils\ComparisonUtil;

test('value1 equal to value2', function () {
    expect(ComparisonUtil::compareByOperator('3', 3, '='))->toBeTrue();
});

test('value1 greater than value2', function () {
    expect(ComparisonUtil::compareByOperator(3.25, 3, '>'))->toBeTrue();
});

test('value1 greater than or equal to value2', function () {
    $result = ComparisonUtil::compareByOperator(3, 3, '>=') && ComparisonUtil::compareByOperator(3.25, 3, '>=');
    expect($result)->toBeTrue();
});

test('value1 less than value2', function () {
    expect(ComparisonUtil::compareByOperator(2.75, 3, '<'))->toBeTrue();
});

test('value1 less than or equal to value2', function () {
    $result = ComparisonUtil::compareByOperator(3, 3, '<=') && ComparisonUtil::compareByOperator(2.75, 3, '<=');
    expect($result)->toBeTrue();
});

test('operator not in supported operators list', function () {
    expect(fn() => ComparisonUtil::compareByOperator(3, 3, '-'))->toThrow(\InvalidArgumentException::class, "Could not find comparison operator with symbol '-'");
});