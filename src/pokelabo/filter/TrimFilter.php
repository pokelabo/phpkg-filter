<?php // -*- coding: utf-8 -*-
/**
 * フィルタ：空白文字のトリミング
 * @package pokelatta
 * @copyright Copyright (c) 2012, Pokelabo Inc.
 * @filesource
 */

namespace pokelabo\filter;

/**
 * フィルタ：空白文字のトリミング
 * @package pokelatta
 */
class TrimFilter extends AbstractFilter {
    /**
     * @var string UNICODEで空白と見なされる文字も取り除く
     */
    protected $_unicode = true;

    /**
     * @var string trimLeftを行う
     */
    protected $_left = true;

    /**
     * @var string trimRightを行う
     */
    protected $_right = true;

    /**
     * フィルタ実行
     * @param string $value パラメータのフィルタ対象キー
     * @return mixed 変換結果
     */
    public function filter($value) {
        if (is_null($value)) return $value;

        if ($this->_unicode) {
            if ($this->_left) {
                if ($this->_right) {
                    return preg_replace('/(^[\p{Zs}\s]+)|([\p{Zs}\s]+$)/us', '', $value);
                } else {
                    return preg_replace('/(^[\p{Zs}\s]+)/us', '', $value);
                }
            } else {
                if ($this->_right) {
                    return preg_replace('/([\p{Zs}\s]+$)/us', '', $value);
                }
            }
        } else {
            if ($this->_left) {
                if ($this->_right) {
                    return trim($value);
                } else {
                    return ltrim($value);
                }
            } else {
                if ($this->_right) {
                    return rtrim($value);
                }
            }
        }
        return $value;
    }
}
