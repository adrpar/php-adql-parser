<?php
/**
 * aliases.php
 *
 * Test case for PHPSQLParser.
 *
 * PHP version 5
 *
 * LICENSE:
 * Copyright (c) 2010-2014 Adrian M. Partl, Justin Swanhart and André Rothe
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
 * @copyright 2010-2014 Adrian M. Partl, Justin Swanhart and André Rothe
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   SVN: $Id: aliases.php 1342 2014-04-15 13:05:04Z phosco@gmx.de $
 * 
 */
namespace PHPSQLParser;
require_once dirname(__FILE__) . '/../../../src/PHPSQLParser/PHPSQLParser.php';
require_once dirname(__FILE__) . '/../../../src/PHPSQLParser/PHPSQLCreator.php';
require_once dirname(__FILE__) . '/../../test-more.php';

$sql = "SELECT DISTINCT TOP(@a + 5) * FROM foo";
$parser = new PHPSQLParser($sql);
$creator = new PHPSQLCreator($parser->parsed);
$created = $creator->created;
$expected = getExpectedValue(dirname(__FILE__), 'adql1.sql', false);
ok($created === $expected, 'ADQL TOP statement with computed position from variable');

$sql = "SELECT DISTINCT TOP   5 * FROM foo";
$parser = new PHPSQLParser($sql);
$creator = new PHPSQLCreator($parser->parsed);
$created = $creator->created;
$expected = getExpectedValue(dirname(__FILE__), 'adql2.sql', false);
ok($created === $expected, 'ADQL TOP statement without brackets');

$sql = "SELECT DISTINCT TOP (5) * FROM foo";
$parser = new PHPSQLParser($sql);
$creator = new PHPSQLCreator($parser->parsed);
$created = $creator->created;
$expected = getExpectedValue(dirname(__FILE__), 'adql3.sql', false);
ok($created === $expected, 'ADQL TOP statement with brackets');

$sql = "SELECT *, BOX('ICRS GEOCENTER', 25.4, -20.0, 10, 10) FROM foo WHERE AREA(CIRCLE('ICRS GEOCENTER', 25.4, -20.0, 1)) > 1";
$parser = new PHPSQLParser($sql);
$creator = new PHPSQLCreator($parser->parsed);
$created = $creator->created;
$expected = getExpectedValue(dirname(__FILE__), 'adql4.sql', false);
ok($created === $expected, 'ADQL geometric function');

$sql = "SELECT TOP 10 POWER(10, alfa_Fe) AS ppress, SQRT(SQUARE(e_pmde)+SQUARE(e_pmra)) AS errTot FROM rave.main WHERE obsDate > '2005-02-02' AND imag<12 AND ABS(rv)>100 ORDER BY ppress";
$parser = new PHPSQLParser($sql);
$creator = new PHPSQLCreator($parser->parsed);
$created = $creator->created;
$expected = getExpectedValue(dirname(__FILE__), 'adql5.sql', false);
ok($created === $expected, 'ADQL complex query 1');

$sql = "SELECT COUNT(*) FROM (SELECT TOP 4000 * FROM arigfh.id) AS q WHERE 4=MOD(decflags/10000, 10)";
$parser = new PHPSQLParser($sql);
$creator = new PHPSQLCreator($parser->parsed);
$created = $creator->created;
$expected = getExpectedValue(dirname(__FILE__), 'adql6.sql', false);
ok($created === $expected, 'ADQL complex query 2 - TOP in subquery');

$sql = "SELECT TOP 5 rv, e_rv, p.raj2000, p.dej2000, p.pmRA, p.pmDE FROM ppmxl.main AS p JOIN rave.main AS rave ON 1=CONTAINS(POINT('', rave.raj2000, rave.dej2000), CIRCLE('', p.raj2000, p.dej2000, 1.5/3600.))";
$parser = new PHPSQLParser($sql);
$creator = new PHPSQLCreator($parser->parsed);
$created = $creator->created;
$expected = getExpectedValue(dirname(__FILE__), 'adql7.sql', false);
ok($created === $expected, 'ADQL complex query 3 - geometric functions');

$sql = "SELECT * FROM ppmxl.main WHERE NOT EXISTS (SELECT * FROM dmubin.main AS d WHERE 1=CONTAINS(POINT('', d.raj2000, d.dej2000), CIRCLE('', q.raj2000, q.dej2000, 0.001)))";
$parser = new PHPSQLParser($sql);
$creator = new PHPSQLCreator($parser->parsed);
$created = $creator->created;
$expected = getExpectedValue(dirname(__FILE__), 'adql8.sql', false);
ok($created === $expected, 'ADQL complex query 4 - geometric functions in subquery');

?>
