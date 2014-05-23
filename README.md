PHP-ADQL-Parser built on PHP-SQL-Parser
=======================================

An extended/altered version of the PHP-SQL-Parser available at 

https://github.com/greenlion/PHP-SQL-Parser

supporting ADQL. Basically this is just an alteration of the reserved key
words and the addition of the geometrical functions plus the TOP statement.


###Full support for the following statement types

    SELECT
    INSERT
    UPDATE
    DELETE
    REPLACE
    RENAME
    SHOW
    SET
    DROP
    CREATE INDEX
    CREATE TABLE
    EXPLAIN
    DESCRIBE

###Other SQL statement types

The ADQL TOP statement
The ADQL geometric functions

Other statements are returned as an array of tokens. This is not as structured as the information available about the above types. See the [ParserManual](https://github.com/greenlion/PHP-SQL-Parser/wiki/Parser-Manual) of the original developer for more information.

###External dependencies

The parser is a self contained class. It has no external dependencies. The parser uses a small amount of regex.

###Focus

The focus of the parser is complete and accurate support for ADQL (building on the complete and accurate support for MySQL SQL of PHP-SQL-Parser). The focus is not on optimizing for performance. It is expected that you will present syntactically valid queries.

###Manual

Please check out the manual of the original project. The only difference to PHP-SQL-Parser is the way the TOP command is presented (as a subnode of the SELECT node) and the support of the ADQL geometrical functions (which are denoted as ext_type = geometrical_function).

[ParserManual](https://github.com/greenlion/PHP-SQL-Parser/wiki/Parser-Manual) - Check out the manual.

###Example Output

**Example Query**

```sql
SELECT STRAIGHT_JOIN a, b, c 
  FROM some_table an_alias
 WHERE d > 5;
```

**Example Output (via print_r)**

```php
Array
( 
    [OPTIONS] => Array
        (
            [0] => STRAIGHT_JOIN
        )       
        
    [SELECT] => Array
        (
            [0] => Array
                (
                    [expr_type] => colref
                    [base_expr] => a
                    [sub_tree] => 
                    [alias] => `a`
                )

            [1] => Array
                (
                    [expr_type] => colref
                    [base_expr] => b
                    [sub_tree] => 
                    [alias] => `b`
                )

            [2] => Array
                (
                    [expr_type] => colref
                    [base_expr] => c
                    [sub_tree] => 
                    [alias] => `c`
                )

        )

    [FROM] => Array
        (
            [0] => Array
                (
                    [table] => some_table
                    [alias] => an_alias
                    [join_type] => JOIN
                    [ref_type] => 
                    [ref_clause] => 
                    [base_expr] => 
                    [sub_tree] => 
                )

        )

    [WHERE] => Array
        (
            [0] => Array
                (
                    [expr_type] => colref
                    [base_expr] => d
                    [sub_tree] => 
                )

            [1] => Array
                (
                    [expr_type] => operator
                    [base_expr] => >
                    [sub_tree] => 
                )

            [2] => Array
                (
                    [expr_type] => const
                    [base_expr] => 5
                    [sub_tree] => 
                )

        )

)
```
