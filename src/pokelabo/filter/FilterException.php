<?php // -*- coding: utf-8 -*-
/**
 * filter related exceptions
 * @package pokelabo/filter
 * @copyright Copyright (c) 2013, Pokelabo Inc.
 * @filesource
 */

namespace pokelabo\filter;

/**
 * ライブラリ 実装関連例外クラス
 * @package pokelabo/filter
 */
class FilterException extends \Exception {
    const NO_ENTRY = 100;
    const NOT_CALLABLE = 101;
}
