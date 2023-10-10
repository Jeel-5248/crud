<?php
require_once('lib/siteurl.php');
require_once('asset/Database.php');
?>
<?php
$data = new Database();
$products = $data->getProductData('*', 'products');
if (isset($_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];
    if ($action == 'delete_product') {
        $a=$data->deleteProductData('products', "WHERE id=$id");
        echo 'success';
        exit;
    }
}
?>
<?php
require_once('lib/header.php');
?>
<h3 class='text-center text-dark'>Welcome To Product Detail Page</h3>
<div class='container-fluid'>
    <div class='d-flex justify-content-end'>
        <button class='btn btn-success'>
            <a href='operation.php' class='text-light'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            Add</a></button>
    </div>
    <div class='row'>
        <table class="table table-striped mt-4 text-center">
            <thead>
                <th>Sr. No</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                <?php
                if (empty($products)) {
                ?>
                    <tr class='bg-light'>
                        <td colspan='6'>
                            <p class='text-center'>no data found</p>
                        </td>
                    </tr>
                    <?php
                } else {
                    foreach ($products as $productData) {
                        $sr += 1;
                    ?>
                        <tr>
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $productData['name']; ?></td>
                            <td><?php echo $productData['description']; ?></td>
                            <td><?php echo $productData['price']; ?></td>
                            <td><button type='button' class='btn border border-0 p-0'><a href="operation.php?product_id=<?php echo $productData['id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square text-dark" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></a></button>
                            </td>
                            <td><button type='button' class='btn border  border-0 p-0' name='delete_product' onclick="deleteData(<?php echo $productData['id']; ?>)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once('lib/footer.php');
?>