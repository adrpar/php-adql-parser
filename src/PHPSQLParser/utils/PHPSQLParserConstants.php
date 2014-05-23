<?php
/**
 * constants.php
 *
 * Some constants for the PHPSQLParser.
 *
 * Copyright (c) 2010-2014, Justin Swanhart
 * with contributions by André Rothe <arothe@phosco.info, phosco@gmx.de>
 * adapted for ADQL by Adrian M. Partl <adrian@partl.net>
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

namespace PHPSQLParser\utils;
class PHPSQLParserConstants {

    private static $inst = null;

    protected $customFunctions = array();
    protected $reserved = array('ABS', 'ABSOLUTE', 'ACOS', 'ACTION', 'ALLOCATE', 'ANY', 'ARE', 'ASIN', 'ASSERTION', 'AT', 'ATAN', 
                                'ATAN2', 'AUTHORIZATION', 'AVG', 'BEGIN', 'BIT', 'BIT_LENGTH', 'CAST', 'CEILING', 'CHAR', 
                                'CHAR_LENGTH', 'CHARACTER_LENGTH', 'COALESCE', 'COLLATION', 'CONVERT', 'COS', 'SIN', 'COUNT', 
                                'CURRENT_USER', 'DAY', 'DEFAULT', 'DEGREES', 'EXISTS', 'EXP', 'EXTRACT', 'FIRST', 'FLOOR', 
                                'FULL', 'GET', 'GLOBAL', 'GO', 'GOTO', 'HOUR', 'IDENTITY', 'IF', 'IMMEDIATE', 'IN', 
                                'INDICATOR', 'INITIALLY', 'INPUT', 'INSERT', 'INTERSECT', 'INTERVAL', 'ISOLATION', 'LANGUAGE', 'LAST',
                                'LEFT', 'LEVEL', 'LOCAL', 'LOG', 'LOG10', 'LOWER', 'MATCH', 'MAX', 'MIN', 'MINUTE', 'MOD', 
                                'MODULE', 'MONTH', 'NAMES', 'NATIONAL', 'NCHAR', 'NEXT', 'NO', 'NULLIF', 'OCTET_LENGTH', 
                                'OF', 'ONLY', 'OPEN', 'OUTPUT', 'OVERLAPS', 'PAD', 'PARTIAL', 'PI', 'POSITION', 'POWER', 'PREPARE', 
                                'PRESERVE', 'PRIOR', 'PUBLIC', 'QUOTE', 'RADIANS', 'RAND', 'RELATIVE', 'RIGHT', 'ROLLBACK', 'ROUND', 'ROWS',
                                'SCHEMA', 'SCROLL', 'SECOND', 'SECTION', 'SESSION', 'SESSION_USER', 'SIZE', 'SPACE', 'SQLCODE', 
                                'SQLERROR', 'SQRT', 'SUBSTRING',  'SUM', 'SYSTEM_USER', 'TAN', 'TIME', 'TIMESTAMP', 'TIMEZONE_HOUR', 
                                'TIMEZONE_MINUTE', 'TOP', 'TRANSACTION', 'TRANSLATE', 'TRANSLATION', 'TRIM', 'TRUNCATE', 
                                'UNKNOWN', 'UPPER', 'USER', 'USE', 'VALUE', 'VIEW', 'WHENEVER', 'WORK', 'YEAR', 'ZONE', 'ADD', 'ALL', 'ALTER',
                                'AND', 'AS', 'ASC', 'BETWEEN', 'BOTH', 'BY', 'CASCADE', 'CASCADED', 'CASE', 'CATALOG', 'CHAR', 
                                'CHARACTER', 'CHECK', 'CLOSE', 'COLLATE', 'COLUMN', 'COMMIT', 'CONNECT', 'CONNECTION', 'CONSTRAINT', 
                                'CONSTRAINTS', 'CONTINUE', 'CORRESPONDING', 'CREATE', 'CROSS', 'CURRENT', 'CURRENT_DATE', 'CURRENT_TIME', 
                                'CURRENT_TIMESTAMP', 'CURSOR', 'DATE', 'DEALLOCATE', 'DECIMAL', 'DECLARE', 'DEFAULT', 'DEFERRABLE', 'DEFERRED',
                                'DELETE', 'DESC', 'DESCRIBE', 'DESCRIPTOR', 'DIAGNOSTICS', 'DISCONNECT', 'DISTINCT', 'DOMAIN',
                                'DOUBLE', 'DROP', 'ELSE', 'END', 'END-EXEC', 'ESCAPE', 'EXCEPT', 'EXCEPTION', 'EXEC', 'EXECUTE', 'EXISTS', 'EXTERNAL',
                                'FALSE', 'FETCH',  'FLOAT', 'FOR', 'FOREIGN', 'FOUND', 'FROM', 'GRANT', 'GROUP', 'HAVING', 'IF', 
                                'IN', 'INNER', 'INSENSITIVE', 'INSERT', 'INT', 'INTEGER', 'INTERVAL', 'INTO', 'IS', 'JOIN', 'KEY', 
                                'LEADING', 'LEFT', 'LIKE',  'MATCH',  'MOD', 'NATURAL', 'NOT', 'NULL', 'NUMERIC', 'ON', 'OPTION', 'OR', 'ORDER', 
                                'OUTER', 'PRECISION', 'PRIMARY', 'PRIVILEGES', 'PROCEDURE', 'READ', 'REAL', 'REFERENCES', 'RESTRICT',
                                'REVOKE', 'RIGHT', 'SELECT', 'SET', 'SMALLINT', 'SOME', 'SQL', 'SQLSTATE', 'STRAIGHT_JOIN', 'TABLE', 
                                'TEMPORARY', 'THEN', 'TO', 'TRAILING', 'TRUE', 'UNION', 'UNIQUE', 'UPDATE', 'USAGE', 'USING', 'VALUES', 'VARCHAR', 
                                'VARYING', 'WHEN', 'WHERE', 'WITH', 'WRITE', 'AREA', 'BOX', 'CENTROID', 'CIRCLE', 'CONTAINS', 'COORD1', 'COORD2',
                                'COORDSYS', 'DISTANCE', 'INTERSECTS', 'POINT', 'POLYGON', 'REGION');

    protected $parameterizedFunctions = array('ABS', 'ABSOLUTE', 'ACOS', 'ASIN', 'ATAN', 'ATAN2', 'AVG', 'BIT_LENGTH', 'CAST', 'CEILING', 'CHAR',
                                              'CHAR_LENGTH', 'CHARACTER_LENGTH',  'COALESCE', 'COLLATION', 'CONVERT', 'COS', 'SIN', 'COUNT',  
                                              'DAY', 'DEFAULT', 'DEGREES', 'EXEC', 'EXP', 'EXTRACT', 'FLOOR', 'HOUR', 'IF', 'IN', 'INSERT',
                                              'INTERVAL', 'LEFT',  'LOG', 'LOG10', 'LOWER', 'MATCH', 'MAX', 'MIN',
                                              'MINUTE', 'MOD', 'MONTH', 'NULLIF', 'OCTET_LENGTH', 'PI', 'POSITION', 'POWER', 'QUOTE',
                                              'RADIANS', 'RIGHT', 'RAND', 'ROUND', 'SECOND', 'SPACE', 'SQRT', 'SUBSTRING', 'SUM', 'TAN', 'TIME',
                                              'TIMESTAMP', 'TRIM', 'TRUNCATE', 'UPPER', 'YEAR', 'AREA', 'BOX', 'CENTROID', 'CIRCLE', 'CONTAINS', 
                                              'COORD1', 'COORD2', 'COORDSYS', 'DISTANCE', 'INTERSECTS', 'POINT', 'POLYGON', 'REGION'); 

    protected $functions = array('ABS', 'ABSOLUTE', 'ACOS', 'ASIN', 'ATAN', 'ATAN2', 'AVG', 'BIT_LENGTH', 'CAST', 'CEILING', 'CHAR', 
                                 'CHAR_LENGTH', 'CHARACTER_LENGTH', 'COALESCE', 'COLLATION', 'CONVERT', 'COS', 'SIN', 'COUNT', 
                                 'RENT_USER', 'DAY', 'DEFAULT', 'DEGREES', 'EXEC', 'EXP', 'EXTRACT', 'FLOOR', 'HOUR', 'IF', 'IN', 'INSERT',
                                 'INTERVAL', 'LEFT', 'LOG', 'LOG10', 'LOWER', 'MATCH', 'MAX', 'MIN', 'MINUTE', 'MOD', 'MONTH', 'NULLIF', 
                                 'OCTET_LENGTH',  'PI', 'POSITION', 'POWER', 'QUOTE', 'RADIANS', 'RAND', 'RIGHT', 'ROUND', 'SECOND', 
                                 'SESSION_USER', 'SPACE', 'SQRT', 'SUBSTRING',  'SUM', 'SYSTEM_USER', 'TAN', 'TIME', 'TIMESTAMP', 'TRIM',
                                 'TRUNCATE', 'UPPER', 'USER', 'YEAR', 'AREA', 'BOX', 'CENTROID', 'CIRCLE', 'CONTAINS', 'COORD1', 'COORD2',
                                 'COORDSYS', 'DISTANCE', 'INTERSECTS', 'POINT', 'POLYGON', 'REGION');

    protected $aggregateFunctions = array('AVG', 'SUM', 'COUNT', 'MIN', 'MAX');

    protected $geometricFunctions = array('AREA', 'BOX', 'CENTROID', 'CIRCLE', 'CONTAINS', 'COORD1', 'COORD2', 'COORDSYS', 'DISTANCE', 
                                          'INTERSECTS', 'POINT', 'POLYGON', 'REGION');

    /**
     * Call this method to get singleton
     *
     * @return PHPSQLParserConstants
     */
    public static function getInstance() {
        if (!isset(self::$inst)) {
            self::$inst = new PHPSQLParserConstants();
        }
        return self::$inst;
    }

    /**
     * Private ctor so nobody else can instance it
     *
     */
    private function __construct() {
        $this->reserved = array_flip($this->reserved);
        $this->aggregateFunctions = array_flip($this->aggregateFunctions);
        $this->geometricFunctions = array_flip($this->geometricFunctions);
        $this->functions = array_flip($this->functions);
        $this->parameterizedFunctions = array_flip($this->parameterizedFunctions);
    }

    private function __clone() {
    }

    public function isGeometricFunction($token) {
        return isset($this->geometricFunctions[$token]);
    }

    public function isAggregateFunction($token) {
        return isset($this->aggregateFunctions[$token]);
    }

    public function isReserved($token) {
        return isset($this->reserved[$token]);
    }

    public function isFunction($token) {
        return isset($this->functions[$token]);
    }

    public function isParameterizedFunction($token) {
        return isset($this->parameterizedFunctions[$token]);
    }

    public function isCustomFunction($token) {
        return isset($this->customFunctions[$token]);
    }

    public function addCustomFunction($token) {
        $token = strtoupper(trim($token));
        $this->customFunctions[$token] = true;
    }

    public function removeCustomFunction($token) {
        $token = strtoupper(trim($token));
        unset($this->customFunctions[$token]);
    }

    public function getCustomFunctions() {
        return array_keys($this->customFunctions);
    }
}
?>
'