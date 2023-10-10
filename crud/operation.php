<?php
require_once('lib/common.php');
require_once('asset/Database.php');
?>
<?php
$productId              = $_GET['product_id'];
$data                   = new Database();

//when user click on edit or click on only save button get the data from database

if (!empty($productId)) {
    $productDetail      = $data->getProductData('*', 'products', "WHERE id=$productId")[0];
    $productName        = $productDetail['name'];
    $productDescription = $productDetail['description'];
    $productPrice       = $productDetail['price'];
}

//when user click on save or save back get all the data from form

if (isset($_POST['save']) || isset($_POST['saveAndBack'])) {
    $productName        = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice       = $_POST['productPrice'];

    //make a array of all form data

    $productData        = array('name' => "'$productName'", 'description' =>"'$productDescription'", 'price' => $productPrice);

    //insert data if id is empty

    if (empty($productId)) {
        // echo 'hii';
        // die;
        $lastInsert = $data->insertProduct('products', $productData);
        if (isset($_POST['save'])) {
            header("Location:operation.php?product_id=$lastInsert");
        } else {
            header("Location:index.php");
        }
    } 
    
    //edit data if id is not empty
    
    else {
        $data->updateProduct('products', $productData, "WHERE id = $productId");
        if (isset($_POST['save'])) {
            header("Location:operation.php?product_id=$productId");
        } else {
            header("Location:index.php");
        }
    }
}
?>
<main>
    <div class='container-fluid'>
        <div class='text-center'>
            <h3> Add Product </h3>
        </div>
        <div class='border border-2' id='pageBorder'>
            <form action='' method='POST' class='my-5 mx-5'>
                <div class='form-outline mb-4'>
                    <label for='productName' class='form-label'>Product Name</label>
                    <input type='text' name='productName' class='from-control' value="<?php echo $productName; ?>" id='productName' placeholder="Enter Your Product Name" required>
                </div>
                <div class='form-outline mb-4'>
                    <label for='productDescription' class='form-label'>Product Description</label>
                    <textarea id="editor" name='productDescription' required> <?php echo $productDescription; ?></textarea>
                </div>
                <div class='form-outline mb-4'>
                    <label for='productPrice' class='form-label'>Product Price</label>
                    <input type='text' name='productPrice' class='from-control' value="<?php echo $productPrice; ?>" id='productPrice' placeholder="Enter Your Product Price" required>
                </div>
                <button type='submit' name='save' id='addEditProduct' class='btn btn-primary'>Save</button>
                <button type='submit' name='saveAndBack' id='addProduct' class='btn btn-primary'>Save And Back</button>
            </form>
        </div>
    </div>
</main>
<?php
require_once('lib/footer.php');
?>