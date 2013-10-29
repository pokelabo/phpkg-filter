<?php // -*- coding: utf-8 -*-
/**
 * フィルタ
 * @package pokelatta
 * @copyright Copyright (c) 2012, Pokelabo Inc.
 * @filesource
 */

namespace pokelabo\filter;

use pokelabo\filter\FilterException;
use pokelabo\utility\StringUtility;

/**
 * フィルタ<br/>
 * 配列に対し、予め設定したフィルタルールを元にフィルタ処理を行う。
 * [ルール]<br/>
 * 各ルールの第一要素には、配列のキーまたはキーの組み合わせを指定する。<br/>
 * そのキーと値に対してフィルタを行うことになる。<br/>
 * 第二要素にはフィルタ名、または配列のクラスを指定する<br/>
 * 第三要素以降は、フィルタ処理への引数を指定する。
 * [処理]<br/>
 * フィルタは先頭ルールから順に行われる。
 * @example
 * <pre>
 * $rules = array(
 *   array('name', 'strip_emoji'),
 *   array('name', 'han2zen'),
 *   array('birthday', 'datetime', 'format' => 'c'),
 * )
 * </pre>
 * @package pokelatta
 */
class Filter {
    /**
     * フィルタルールリスト<br/>
     * 各ルールの第一要素には、配列のキーまたはキーの組み合わせを指定する。<br/>
     * そのキーと値に対してフィルタ処理を行うことになる。<br/>
     * 第二要素にはフィルタ名、または配列のクラスを指定する<br/>
     * 第三要素以降は、フィルタ処理への引数を指定する。
     * @var array
     */
    protected $_rule_list;

    /**
     * コンストラクタ
     * @param array $rule_list
     */
    public function __construct($rule_list) {
        $this->_rule_list = $rule_list;
    }

    /**
     * フィルタ実行
     * @param array $param 対象パラメータ
     * @return boolean 全パラメータが妥当の場合はtrue
     */
    public function __invoke($param_map) {
        $this->_error_map = array();

        foreach ($this->_rule_list as $rule) {
            $param_key = array_shift($rule);
            $spec_filter = $this->getSpecFilter(array_shift($rule));

            if ($spec_filter instanceof AbstractFilter) {
                if ($rule) {
                    $spec_filter->setOptions($rule);
                }
            
                if (is_array($param_key)) {
                    $param_map = $spec_filter->filterCombination($param_key, $param_map);
                } else if (array_key_exists($param_key, $param_map)) {
                    $param_map[$param_key] = $spec_filter->filter($param_map[$param_key]);
                }
                continue;
            }

            if (!array_key_exists($param_key, $param_map)) {
                continue;
            }
            
            if ($rule) {
                array_unshift($rule, $param_map[$param_key]);
                $param_map[$param_key] = call_user_func_array($spec_filter, $rule);
            } else {
                $param_map[$param_key] = call_user_func($spec_filter, $param_map[$param_key]);
            }
        }

        return $param_map;
    }

    /**
     * 個別フィルタクラスインスタンスを取得する
     * @param string $filter_name_or_class_name フィルタ処理名かクラス名
     * @return FilterInterface 個別フィルタクラスインスタンス
     */
    protected function getSpecFilter($filter_name_or_class_name) {
        $class_name = 'pokelabo\filter\\' .
            StringUtility::toCamel($filter_name_or_class_name) . 'Filter';
        if (!class_exists($class_name)) {
            if (class_exists($filter_name_or_class_name)) {
                $class_name = $filter_name_or_class_name;
            } else if (function_exists($filter_name_or_class_name)) {
                return $filter_name_or_class_name;
            } else {
                throw new FilterException(
                    "フィルタクラスが存在しません: $filter_name_or_class_name",
                    FilterException::NO_ENTRY);
            }
        }

        return new $class_name;
    }
}
