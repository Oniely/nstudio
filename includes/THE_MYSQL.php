<?php

require_once 'THE_CONNECTION.php';

class Mysql extends Database {

    public function getConnection() {
        // if you want to change the default connection you can add
        // 4 arguments for this database instance host, user, pass, dbname
        $db = new Database();
        return $db->connectDB();
    }

    public function select($query, $params = []) {
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectWhere($tableName, $rowName, $operator, $value, $valueType)
    {
        $sqlQuery = "SELECT * FROM {$tableName} WHERE {$rowName} {$operator} :value";

        $stmt = $this->getConnection()->prepare($sqlQuery);

        if ($valueType == 'int') {
            $stmt->bindValue(':value', $value, PDO::PARAM_INT);
        } elseif ($valueType == 'string' || $valueType == "str") {
            $stmt->bindValue(':value', $value, PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($query, $params = []) {

        $stmt = $this->getConnection()->prepare($query);
        return $stmt->execute($params);
    }

    public function update($query, $params = []) {
        return $this->insert($query, $params);
    }

    public function delete($query, $params = []) {
        $stmt = $this->getConnection()->prepare($query);
        return $stmt->execute($params);
    }

    public function countRows($query, $params = []) {
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute($params);
        $rowCount = $stmt->rowCount();
        return $rowCount;
    }

    public function countRowsWhere($tableName, $rowName, $operator, $value, $valueType)
    {
        $sqlQuery = "SELECT * FROM {$tableName} WHERE {$rowName} {$operator} :value";

        $stmt = $this->getConnection()->prepare($sqlQuery);

        if ($valueType == 'int') {
            $stmt->bindValue(':value', $value, PDO::PARAM_INT);
        } elseif ($valueType == 'string' || $valueType == "str") {
            $stmt->bindValue(':value', $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        $rowCount = $stmt->rowCount();
        return $rowCount;
    }

    public function getCategoryProducts($category, $newOnly = false, $limit = 20)
    {
        $initialQuery =
            "SELECT
                product_tbl.*,
                product_item.*
            FROM
                product_tbl
            JOIN 
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.product_category = ?";

        if ($newOnly == true) {
            $initialQuery .= " AND product_tbl.product_new = 1 ";
        }

        $byQuery = "GROUP BY product_tbl.product_id, product_item.colour_id ORDER BY RAND() LIMIT $limit";
        $sqlQuery = $initialQuery .= $byQuery;

        return $this->select($sqlQuery, [$category]);
    }

    public function getColorButtons($product_id)
    {

        $sqlQuery =
            "SELECT DISTINCT 
                product_item.product_id, 
                product_item.colour_id, 
                colour.colour_value, 
                colour.hex_code 
            FROM colour 
            JOIN product_item 
            WHERE colour.id = product_item.colour_id 
            AND product_item.product_id = ?";

        return $this->select($sqlQuery, [$product_id]);
    }

    public function getSearchProducts($keyword, $type_id = null)
    {

        $key = "%$keyword%";
        $category = $keyword;

        $initialQuery =
            "SELECT
                product_tbl.*,
                product_item.*
            FROM
                product_tbl
            JOIN
                product_item ON product_tbl.product_id = product_item.product_id
            ";

        if ($type_id == null || $type_id < 1) {
            $initialQuery .= " WHERE product_tbl.keywords LIKE ? ";
        } else {
            $initialQuery .= " WHERE product_tbl.product_type_id = ? AND product_tbl.product_category = ? ";
        }

        $byQuery = "GROUP BY product_tbl.product_id, product_item.colour_id ORDER BY RAND()";
        $sqlQuery = $initialQuery .= $byQuery;

        if ($type_id == null || $type_id < 1) {
            return $this->select($sqlQuery, [$key]);
        } else {
            return $this->select($sqlQuery, [$type_id, $category]);
        }
    }

    public function getShowCaseProducts()
    {
        $sqlQuery =
            "SELECT * 
            FROM product_item 
            GROUP BY product_id
            ORDER BY RAND() LIMIT 4";

        return $this->select($sqlQuery);
    }

    public function countCategoryRows($category, $newOnly = false) {
        $initialQuery =
            "SELECT
                product_tbl.*,
                product_item.*
            FROM
                product_tbl
            JOIN 
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.product_category = ?";

        if ($newOnly == true) {
            $initialQuery .= " AND product_tbl.product_new = 1 ";
        }
        $byQuery = "GROUP BY product_tbl.product_id, product_item.colour_id";
        $sqlQuery = $initialQuery .= $byQuery;

        $stmt = $this->getConnection()->prepare($sqlQuery);
        $stmt->execute([$category]);

        $rowCount = $stmt->rowCount();
        return $rowCount;
    }

    public function getCategoryCount($category) {
        $sqlQuery = 
            "SELECT DISTINCT
                product_type.*,
                product_tbl.product_category category
            FROM
                product_type
            JOIN 
                product_tbl ON product_tbl.product_category = ?
            AND 
                product_tbl.product_type_id = product_type.id";

        return $this->countRows($sqlQuery, [$category]);
    }

    public function getCategoryLinks($category) {
        $sqlQuery =
            "SELECT DISTINCT
                product_type.*,
                product_tbl.product_category category
            FROM
                product_type
            JOIN 
                product_tbl ON product_tbl.product_category = ?
            AND 
                product_tbl.product_type_id = product_type.id";
        
        return $this->select($sqlQuery, [$category]);
    }
}