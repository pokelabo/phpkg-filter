<?php // -*- coding: utf-8 -*-

use pokelabo\filter\Filter;

$steps->When('/^値"([^"]*)"を"([^"]*)"に"([^"]*)"を設定してフィルタする$/', function($world, $arg1, $arg2, $arg3) {
    $arg1 = trim($arg1, "'");
    $arg1 = str_replace('\n', "\n", $arg1);
    if ($arg1 === 'null') $arg1 = null;

    $option_map = $arg3 ? yaml_parse($arg3) : array();
    $rule = array('value', $arg2) + $option_map;
    $rule_list[] = $rule;

    $filter = new Filter($rule_list);

    $output = $filter(array('value' => $arg1));
    $world->output = $output['value'];
});

// $steps->When('/^値"([^"]*)"を"([^"]*)"でフィルタする$/', function($world, $arg1, $arg2) {
//     $arg1 = trim($arg1, "'");
//     $arg1 = str_replace('\n', "\n", $arg1);
//     if ($arg1 === 'null') $arg1 = null;
// 
//     $rule_list[] = array('value', $arg2);
// 
//     $filter = new Filter($rule_list);
//     $output = $filter(array('value' => $arg1));
//     $world->output = $output['value'];
// });

$steps->When('/^値"([^"]*)"を正規表現"([^"]*)"で"([^"]*)"に置き換えるよう"([^"]*)"でフィルタする$/', function($world, $arg1, $arg2, $arg3, $arg4) {
    $arg1 = trim($arg1, "'");
    $arg1 = str_replace('\n', "\n", $arg1);
    if ($arg1 === 'null') $arg1 = null;

    $rule_list[] = array('value', $arg4, 'search' => $arg2, 'replace' => $arg3);

    $filter = new Filter($rule_list);
    $output = $filter(array('value' => $arg1));
    $world->output = $output['value'];
});

$steps->When('/^値"([^"]*)"を検索文字"([^"]*)"で"([^"]*)"に置き換えるよう"([^"]*)"でフィルタする$/', function($world, $arg1, $arg2, $arg3, $arg4) {
    $arg1 = trim($arg1, "'");
    $arg1 = str_replace('\n', "\n", $arg1);
    if ($arg1 === 'null') $arg1 = null;

    $rule_list[] = array('value', $arg4, 'search' => $arg2, 'replace' => $arg3);

    $filter = new Filter($rule_list);
    $output = $filter(array('value' => $arg1));
    $world->output = $output['value'];
});

$steps->Given('/^フィルタの結果は"([^"]*)"である$/', function($world, $arg1) {
    $arg1 = trim($arg1, "'");
    $arg1 = str_replace('\n', "\n", $arg1);
    if ($arg1 === 'null') $arg1 = null;

    assertSame($arg1, $world->output);
});

$steps->When('/^"([^"]*)", "([^"]*)", "([^"]*)"とあるとき、"([^"]*)"で妥当性判定を行うと"([^"]*)"例外が発生する$/', function($world, $arg1, $arg2, $arg3, $arg4, $arg5) {
    $key = yaml_parse($arg1);
    $param_map = yaml_parse($arg2);
    $option_map = $arg3 ? yaml_parse($arg3) : array();

    $rule = array($key, $arg4) + $option_map;
    $rule_list = array($rule);

    $world->filter = new Filter($rule_list);
    assertThrowException($arg5, function() use ($world, $param_map) {
        $world->filter->validate($param_map);
    });
});
