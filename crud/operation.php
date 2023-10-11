<?php
require_once('lib/common.php');
require_once('asset/Database.php');
?>
<?php
$productId = $_GET['product_id'];
$data = new Database();

//when user click on edit or click on only save button get the data from database

if (!empty($productId)) {
    $productDetail = $data->getProductData('*', 'products', "WHERE id=$productId")[0];
    $productName = $productDetail['name'];
    $productDescription = $productDetail['description'];
    $productPrice = $productDetail['price'];
    $productStatus = $productDetail['status'];
    $registerDateDefault = $productDetail['register_date'];
    $modifyDateTime = date('y-m-d H:i:s');
}

//when user click on save or save back get all the data from form

if (isset($_POST['save'])) {
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productStatus = $_POST['status'];
    if (empty($productId)) {
        $registerDate = date('y-m-d H:i:s');
    } else {
        $registerDate = $registerDateDefault;
    }
    if (!empty($productId)) {
        $modifyDate = $modifyDateTime;
    } else {
        $modifyDate = null;
    }

    //make a array of all form data

    $productData = [
        'name' => $productName,
        'description' => $productDescription,
        'price' => $productPrice,
        'status' => $productStatus, 
        'register_date' => $registerDate,
        'modify_date' => $modifyDate
    ];


    if (empty($productId)) {
        $lastInsert = $data->insertProduct('products', $productData);    //insert data if id is empty
            header("Location:index.php");
    } else {
        $data->updateProduct('products', $productData, "WHERE id = $productId"); //edit data if id is not empty
            header("Location:index.php");
    }
}
?>
<main>
    <div class='container-fluid'>
        <div class='d-flex' id='main'>
            <div class='text-center' id='title'>
                <h3> Add Product </h3>
            </div>
            <div class="text-end" id='button'>
                <a href='index.php'><button type='button' name='back' id='back' class='btn btn-primary'>Back</button></a>
            </div>
        </div>
        <div class='border border-2' id='pageBorder'>
            <form action='' method='POST' class='my-5 mx-5'>
                <div class='form-outline mb-4'>
                    <label for='productName' class='form-label'>Product Name</label>
                    <input type='text' name='productName' class='from-control' value="<?= $productName; ?>" id='productName' placeholder="Enter Your Product Name" required>
                </div>
                <div class='form-outline mb-4'>
                    <label for='productDescription' class='form-label'>Product Description</label>
                    <textarea id="editor" name='productDescription' required> <?= $productDescription; ?></textarea>
                </div>
                <div class='form-outline mb-4'>
                    <label for='productPrice' class='form-label'>Product Price</label>
                    <input type='text' name='productPrice' class='from-control' value="<?= $productPrice; ?>" id='productPrice' placeholder="Enter Your Product Price" required>
                </div>
                <div class='form-outline mb-4'>
                <label for='status' class='form-label'>Product status</label>
                <select class="form-select" name='status' id='status' class='mb-2 ' required>
                    <option value=' '>Select Product Status</option>
                    <option value='0' <?= (($productStatus == '0') ? 'selected' : '') ?>>0</option>
                    <option value='1' <?= (($productStatus == '1') ? 'selected' : '')  ?>>1</option>
                </select>
                </div>
                <div class='mt-2'>
                <button type='submit' name='save' id='addEditProduct' class='btn btn-primary'>Save</button>
                <button type='reset' name='reset' id='reset' class='btn btn-primary'>Reset</button>
                </div>
            </form>
        </div>
    </div>
</main>
<?php
require_once('lib/footer.php');
?>