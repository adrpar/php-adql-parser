<?php
/**
 * SelectProcessor.php
 *
 * This file implements the processor for the SELECT statements.
 *
 * Copyright (c) 2010-2014, Justin Swanhart
 * with contributions by André Rothe <arothe@phosco.info, phosco@gmx.de>
 * and Adrian M. Partl <adrian@partl.net>
 *
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *   * Redistributions of source code must retain the above copyright notice,
 *     this list of conditions and the following disclaimer.
 *   * Redistributions in binary form must reproduce the above copyright notice,
 *     this list of conditions and the following disclaimer in the documentation
 *     and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT
 * SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
 * TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR
 * BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
 * DAMAGE.
 */

namespace PHPSQLParser\processors;
require_once(dirname(__FILE__) . '/SelectExpressionProcessor.php');

/**
 * 
 * This class processes the SELECT statements.
 * 
 * @author arothe
 * 
 */
class SelectProcessor extends SelectExpressionProcessor {

    public function process($tokens) {
        $expression = "";
        $expressionList = array();

        $capture = false;

        foreach ($tokens as $token) {
            if ($this->isCommaToken($token)) {
                $expression = parent::process(trim($expression));
                $expression['delim'] = ',';
                $expressionList[] = $expression;
                $expression = "";
            } else if ($capture === true) {
                if(!$this->isWhitespaceToken($token)) {
                    $capture = false;
                } else {
                    $expression['delim'] = ' ';
                    continue;
                }

                $expression['sub_tree'][] = parent::process(trim($token));
                $expressionList[] = $expression;
                $expression = "";
            } else {
                switch (strtoupper($token)) {

                // add more SELECT options here
                case 'DISTINCT':
                case 'STRAIGHT_JOIN':
                    $expression = parent::process(trim($token));
                    $expression['delim'] = ' ';
                    $expressionList[] = $expression;
                    $expression = "";
                    break;
                case 'TOP':
                    $expression = parent::process(trim($token));
                    $expression['delim'] = "";
                    $capture = true;
                    break;

                default:
                    $expression .= $token;
                }
            }
        }
        if ($expression) {
            $expression = parent::process(trim($expression));
            $expression['delim'] = false;
            $expressionList[] = $expression;
        }

        return $expressionList;
    }
}
?>
