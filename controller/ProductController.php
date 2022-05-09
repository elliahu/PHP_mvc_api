<?php
class ProductController extends Controller{

    /// GET /product/{id}
    function get($params){
        try{
            if(empty($params)){
                /// GET /product/
                $products = ProductTable::getProducts();
                $this->Ok($products);
            }
            else{
                /// GET /product/id
                $id = $params[0];
                $product = ProductTable::getProductById($id);
                $this->Ok($product);
            }
        }
        catch( Exception $e){
            $this->Error($e->getMessage());
        }
    }

    /// POST /product/
    function post($params){
        try{
            // from request body
            $postContetnRaw = file_get_contents('php://input');
            $productRaw = json_decode($postContetnRaw);
            if( $productRaw !== null &&
                property_exists($productRaw, "name") &&
                property_exists($productRaw,"price")){

                $product = new Product();
                $product->name = $productRaw->name;
                $product->price = $productRaw->price;
                ProductTable::createProduct($product);
                $this->Ok(new stdClass());
            }
            else {
                $this->BadRequest(new stdClass());
            }
        }
        catch( Exception $e){
            $this->Error($e->getMessage());
        }
    }


    /// PUT /products/
    function put($params){
        try{
            // from request body
            $postContetnRaw = file_get_contents('php://input');
            $productRaw = json_decode($postContetnRaw);
            if( $productRaw !== null &&
                property_exists($productRaw, "name") &&
                property_exists($productRaw,"price") && 
                property_exists($productRaw, "id")){

                $product = new Product();
                $product->id = $productRaw->id;
                $product->name = $productRaw->name;
                $product->price = $productRaw->price;
                ProductTable::updateProduct($product);
                $this->Ok(new stdClass());
            }
            else {
                $this->BadRequest(new stdClass());
            }
        }
        catch( Exception $e){
            $this->Error($e->getMessage());
        }
    }

    function delete($params){
        try{
            if(!empty($params)){
                ProductTable::deleteProduct($params[0]);
                $this->Ok(new stdClass());
            }
            else{
                $this->BadRequest(new stdClass());
            }
        }
        catch( Exception $e){
            $this->Error($e->getMessage());
        }
    }
}

?>