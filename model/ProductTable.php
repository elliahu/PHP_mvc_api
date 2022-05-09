<?php 
class ProductTable{
    /// Třída představuje databázovou tabulku Product
    /**
     * CREATE TABLE `product` (
     *  `id` int(11) NOT NULL,
     *  `name` varchar(250) COLLATE utf8_czech_ci NOT NULL,
     *  `price` double NOT NULL
     *  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
     */

    /// Využívá table data gateway pattern

    static function createProduct(Product $product){
        // INSERT INTO Product(name,price) VALUES ('somename', 145.50)
        $sql = "INSERT INTO Product(name,price) VALUES ('". $product->name . "'," . $product->price. ")";
        Database::executeNonQuery($sql);
    }

    static function getProductById(int $id){
        // SELECT * FROM Product WHERE id = 1
        $sql = "SELECT * FROM Product WHERE id = " . $id;
        $result = Database::executeReader($sql);
        $product = null;
        foreach($result as $row){
            $product = new Product();
            $product->id = $row["id"];
            $product->name = $row["name"];
            $product->price = $row["price"];
        }
        return $product;
    }

    static function getProducts(){
        // SELECT * FROM Product
        $sql = "SELECT * FROM Product";
        $result = Database::executeReader($sql);
        $products = array();
        foreach($result as $row){
            $product = new Product();
            $product->id = $row["id"];
            $product->name = $row["name"];
            $product->price = $row["price"];
            $products[] = $product;
        }
        return $products;
    }

    static function deleteProduct(int $id){
        // DELETE FROM Product WHERE id = 1
        $sql = "DELETE FROM Product WHERE id = " . $id;
        Database::executeNonQuery($sql);
    }

    static function updateProduct(Product $product){
        // UPDATE Product set name = 'somename', price = 123 WHERE id = 1
        $sql = "UPDATE Product SET name = '" . $product->name . "', price = " . $product->price . " WHERE id = " . $product->id;
        Database::executeNonQuery($sql);
    }

}
?>