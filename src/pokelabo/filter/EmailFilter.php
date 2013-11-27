<?php // -*- coding: utf-8 -*-
/**
 * Emailフィルタ
 * @package pokelatta
 * @copyright Copyright (c) 2013, Pokelabo Inc.
 * @filesource
 */

namespace pokelabo\filter;

/**
 * フィルタ：空白文字のトリミング
 * @package pokelatta
 */
class EmailFilter extends AbstractFilter {
    /**
     * @var string 標準化を行う(+alias部分を取り除く)
     */
    protected $_normalize = false;

    /**
     * フィルタ実行
     * @param string $value パラメータのフィルタ対象キー
     * @return mixed 変換結果
     */
    public function filter($value) {
        if (is_null($value)) return $value;

        if ($this->_normalize) {
            $value = preg_replace('/\+.*?@/', '@', $value);
        }
        return $value;
    }
}
