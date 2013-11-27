<?php // -*- coding: utf-8 -*-
/**
 * base64 encode
 * @package pokelatta
 * @copyright Copyright (c) 2013, Pokelabo Inc.
 * @filesource
 */

namespace pokelabo\filter;

/**
 * Filter Base64 encode
 * @package pokelatta
 */
class Base64EncodeFilter extends AbstractFilter {
    /**
     * Execute filter
     * @param string $value 
     * @return mixed 
     */
    public function filter($value) {
        if (is_null($value)) return $value;

        return base64_encode($value);
    }
}
