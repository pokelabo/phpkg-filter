<?php // -*- coding: utf-8 -*-
/**
 * base64 decode
 * @package pokelatta
 * @copyright Copyright (c) 2013, Pokelabo Inc.
 * @filesource
 */

namespace pokelabo\filter;

/**
 * Filter Base64 decode
 * @package pokelatta
 */
class Base64DecodeFilter extends AbstractFilter {
    /**
     * Execute filter
     * @param string $value 
     * @return mixed 
     */
    public function filter($value) {
        if (is_null($value)) return $value;

        return base64_decode($value);
    }
}
