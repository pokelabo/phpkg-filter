<?php // -*- coding: utf-8 -*-
/**
 * Email Filter
 * @package pokelatta
 * @copyright Copyright (c) 2013, Pokelabo Inc.
 * @filesource
 */

namespace pokelabo\filter;

/**
 * Email Filter
 * @package pokelatta
 */
class EmailFilter extends AbstractFilter {
    /**
     * @var bool  to normalize email adress string.
     */
    protected $_normalize = true;

    /**
     * @var bool  to strip alias part.
     */
    protected $_strip_alias = false;

    /**
     * Execute filter
     * @param string $value  subject value
     * @return mixed filtered string
     */
    public function filter($value) {
        if (is_null($value)) return $value;

        if ($this->_normalize) {
            // Android terminal may send hyphen '-' as 'ー'
            $value = str_replace('ー', '-', $value);
        }

        if ($this->_strip_alias) {
            $value = preg_replace('/\+.*?@/', '@', $value);
        }
        return $value;
    }
}
