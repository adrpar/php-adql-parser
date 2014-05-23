<?php
/**
 * positions.php
 *
 * Test case for PHPSQLParser.
 *
 * PHP version 5
 *
 * LICENSE:
 * Copyright (c) 2010-2014 Justin Swanhart and André Rothe
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. The name of the author may not be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 * NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
 * THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * @author    André Rothe <andre.rothe@phosco.info>
 * @copyright 2010-2014 Justin Swanhart and André Rothe
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   SVN: $Id: positions.php 1342 2014-04-15 13:05:04Z phosco@gmx.de $
 * 
 */
namespace PHPSQLParser;
require_once dirname(__FILE__) . '/../../../src/PHPSQLParser/PHPSQLParser.php';
require_once dirname(__FILE__) . '/../../test-more.php';

$parser = new PHPSQLParser();

$sql = 'SELECT colA hello From test t';
$p = $parser->parse($sql, true);
ok($p['SELECT'][0]['position'] == 7, 'position of column');
ok($p['SELECT'][0]['alias']['position'] == 12, 'position of column alias');
ok($p['FROM'][0]['position'] == 23, 'position of table');
ok($p['FROM'][0]['alias']['position'] == 28, 'position of table alias');


$sql = "SELECT colA hello From test\nt";
$p = $parser->parse($sql, true);
ok($p['SELECT'][0]['position'] == 7, 'position of column');
ok($p['SELECT'][0]['alias']['position'] == 12, 'position of column alias');
ok($p['FROM'][0]['position'] == 23, 'position of table');
ok($p['FROM'][0]['alias']['position'] == 28, 'position of table alias');


$sql = "SELECT a.*, c.*, u.users_name FROM SURVEYS as a  INNER JOIN SURVEYS_LANGUAGESETTINGS as c ON ( surveyls_survey_id = a.sid AND surveyls_language = a.language ) AND surveyls_survey_id=a.sid and surveyls_language=a.language  INNER JOIN USERS as u ON (u.uid=a.owner_id)  ORDER BY surveyls_title";
$p = $parser->parse($sql, true);
$expected = getExpectedValue(dirname(__FILE__), 'positions1.serialized');
eq_array($p, $expected, 'a long query with join and order clauses');

?>
