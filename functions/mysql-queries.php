<?php
// SCOALA IT DB
$mysqli = mysqli_connect("localhost", "root", "scoalait123", "web-05-andreiComan");

/////////////////////////////////////////////
///////////////// CREATE ///////////////////
///////////////////////////////////////////
function insertInto($table, $data) { // $data = ['column' => $column, 'value' => $value]
    global $mysqli;

    $columnNames = [];
    $valuesNames = [];

    foreach ($data as $column => $value) {
        $columnNames[] = mysqli_real_escape_string($mysqli, $column);
        $valuesNames[] = mysqli_real_escape_string($mysqli, $value);
    }

//    var_dump("INSERT INTO `web-05-andreiComan`.`".$table."` (`".implode("`, `", $columnNames)."`) VALUES ('".implode("', '", $valuesNames)."')");die;

    $query = mysqli_query(
        $mysqli,
        "INSERT INTO `web-05-andreiComan`.`".$table."` (`".implode("`, `", $columnNames)."`) VALUES ('".implode("', '", $valuesNames)."')"
    );
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////
///////////////// READ /////////////////
///////////////////////////////////////
// Read all from table
function readMySql($table) {
    global $mysqli;
    $myQuery = mysqli_query($mysqli, "SELECT * FROM `".$table."`;");

    return $myQuery->fetch_all(MYSQLI_ASSOC);
}

// $variableName = 'product';
// $product = 'Laptop';
// $$variableName == 'Laptop';
//  ['products', 'productCategories']
function readMySqlTables($tableNames) {
    global $mysqli;
    $data = [];

    foreach ($tableNames as $tableName) {
        $$tableName = readMySql($tableName);
        $data[$tableName] = $$tableName;
    }

    return $data;
}

/// readMySqlTables(['products', 'productCategories']) ===>:
///
/// $data == [];
///
/// foreach['products', 'productCategories']: ==>
///
///     1.
///     $products = readMySql('products');
///
///         readMysql('products') ===>:
///
///         $mysqli == mysqli_connect("localhost", "root", "scoalait123", "web-05-andreiComan");
///
///         $myQuery = mysqli_query($mysqli, "SELECT * FROM `".$table."`;");
///
///         return $myQuery->fetch_all(MYSQLI_ASSOC);
///
///         <=== end readMysql('products');
///
///     $data['products'] == $products;
///
///     $data == ['products' => $products];
///
///     2.
///     $productCategories = readMySql('productCategories');
///     $data['productCategories'] == $productCategories;
///
///     $data == ['products' => $products], 'productCategories' => $productCategories;
/// <== endforeach
///
///     return $data == ['products' => $products], 'productCategories' => $productCategories;
///
/// <== end readMYSqlTables(['products', 'productCategories']);

function findBy($table, $filters) {
    global $mysqli;

    $criterias = [];
    foreach ($filters as $column => $value) {
        $criterias[] = "`".$column."`='".mysqli_real_escape_string($mysqli, $value)."'";
    }

    $query = mysqli_query($mysqli, "SELECT * FROM `".$table."` WHERE ".implode('AND', $criterias));

    return $query->fetch_all(MYSQLI_ASSOC);
}

function findByLike($table, $filters) {
    global $mysqli;

    $criterias = [];
    foreach ($filters as $column => $value) {
        $criterias[] = "`".$column."` LIKE '".mysqli_real_escape_string($mysqli, $value)."'";
    }

    $query = mysqli_query($mysqli, "SELECT * FROM `".$table."` WHERE ".implode('AND', $criterias));

    return $query->fetch_all(MYSQLI_ASSOC);
}

function findOneBy($table, $filters) {
    $result = findBy($table, $filters);

    if (count($result) > 0) {
        return $result[0];
    }

    return false;
}

function find($table, $id) {
    $result = findOneBy($table, ['id' => $id]);

    if (count($result) > 0) {
        return $result;
    }

    return false;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////
////////////////// UPDATE //////////////////
///////////////////////////////////////////
function updateData($table, $filters, $newData) {
    global $mysqli;

    $criterias = pairColWithVal($filters);
    $myUpdate = pairColWithVal($newData);

//    var_dump("UPDATE `".$table."` SET ".implode('AND', $myUpdate)." WHERE ".implode('AND', $criterias));
    $query = mysqli_query($mysqli, "UPDATE `".$table."` SET ".implode('AND', $myUpdate)." WHERE ".implode('AND', $criterias));
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////
/////////////// DELETE /////////////////
///////////////////////////////////////
function deleteData($table, $filters) {
    global $mysqli;

    $criterias = [];
    foreach ($filters as $column => $value) {
        $criterias[] = "`".$column."`='".mysqli_real_escape_string($mysqli, $value)."'";
    }

//    var_dump("DELETE FROM `".$table."` WHERE ".implode('AND', $criterias));
    $query = mysqli_query($mysqli, "DELETE FROM `".$table."` WHERE ".implode('AND', $criterias));
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
