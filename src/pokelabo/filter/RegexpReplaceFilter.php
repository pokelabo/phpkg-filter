<?php // -*- coding: utf-8 -*-
/**
 * フィルタ：正規表現置換
 * @package pokelatta
 * @copyright Copyright (c) 2012, Pokelabo Inc.
 * @filesource
 */

namespace pokelabo\filter;

/**
 * フィルタ：正規表現置換
 * @package pokelatta
 */
class RegexpReplaceFilter extends AbstractFilter {
    /**
     * @var string 正規表現
     */
    protected $_search;
    /**
     * @var string 置換文字列
     */
    protected $_replace;

    /**
     * フィルタ実行
     * @param string $key パラメータのフィルタ対象キー
     * @param array $param_map パラメータ
     * @return mixed 変換結果
     */
    public function filter($value) {
        if (is_null($value)) return $value;

        $value = preg_replace($this->_search, $this->_replace, $value);
        return $value;
    }
}
