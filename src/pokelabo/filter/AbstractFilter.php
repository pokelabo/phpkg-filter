<?php // -*- coding: utf-8 -*-
/**
 * フィルタ処理基底
 * @package pokelatta
 * @copyright Copyright (c) 2012, Pokelabo Inc.
 * @filesource
 */

namespace pokelabo\filter;

use pokelabo\filter\FilterException;

/**
 * フィルタ処理基底
 * @package pokelatta
 */
abstract class AbstractFilter {
    /**
     * オプションを設定する
     * @param array $option_map
     */
    public function setOptions($option_map) {
        foreach ($option_map as $key => $value) {
            $property = '_' . $key;
            if (!property_exists($this, $property)) {
                throw new FilterException("不明なオプション: '$key'",
                                          FilterException::NO_ENTRY);
            }
            $this->$property = $value;
        }
    }
    
    /**
     * フィルタ実行
     * @param mixed $value パラメータ
     * @return mixed 変換後の値
     */
    public function filter($value) {
        return $value;
    }

    /**
     * 組み合わせフィルタ処理実行
     * @param array $key_list パラメータのフィルタ処理対象キーの組み合わせ
     * @param array $param パラメータ
     * @return mixed 変換結果
     */
    public function filterCombination($key_list, $param_map) {
        return $param_map;
    }
}
