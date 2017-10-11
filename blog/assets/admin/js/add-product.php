<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'logout') {
        require_once './Login.php';
        $login = new Login();
        $message = $login->adminLogout();        
       
        $_SESSION['message'] = $message;
    }
}

$message = '';
if (isset($_POST['btn'])) {
    require_once './Product.php';
    $product = new Product();
    $message = $product->saveAllProductInfo($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Product</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                </div>
                
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="add-product.php">Add Product <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Manage Product</a></li>                        
                    </ul>
                    <form class="navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name']; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">                                
                                <li role="separator" class="divider"></li>
                                <li class="text-center"><a href="?status=logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav> 

        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <form class="form-horizontal" action="" method="POST">
                        <h3 class="text-center text-primary">Add Product</h3>
                        <hr/>
                        <h3 class="text-center text-success"><?php echo $message; ?></h3>

                        <div class="form-group">
                            <label for="inputProductName" class="col-sm-2 control-label">Product Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="product_name" required class="form-control" id="inputProductName" placeholder="Product Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputProductPrice" class="col-sm-2 control-label">Product Price</label>
                            <div class="col-sm-10">
                                <input type="text" name="product_price" required class="form-control" id="inputProductPrice" placeholder="Product Price">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputProductQuantity" class="col-sm-2 control-label">Product Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" name="product_quantity" required class="form-control" id="inputProductQuantity" placeholder="Product Quantity">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputProductDescription" class="col-sm-2 control-label">Product Description</label>
                            <div class="col-sm-10">
                                <textarea name="product_description" cols="30" rows="10" required style="resize: vertical;"  class="form-control" id="inputProductDescription" placeholder="Product Description"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPublicationStatus" class="col-sm-2">Publication Status</label>                      
                            <div class="col-sm-10">
                                <select class="form-control" id="inputPublicationStatus" name="publication_status">
                                    <option>---Select Publication Status---</option>
                                    <option value="1">Published</option>
                                    <option value="0">Unpublished</option>
                                </select>
                            </div>
                        </div>                        

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="btn" class="btn btn-success btn-block">Save Product Info</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>   

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>


<!--<a href="add-product.php">Add Product</a>
<a href="view-product.php">View Product</a>


<h3>Add Product</h3>

<h1 style="color: green; font-family: sans-serif; "><?php //echo $message;   ?></h1>

<form action="" method="POST">
    <table>
        <tr>
            <td>Product Name</td>
            <td><input type="text" name="product_name" required></td>
        </tr>
        <tr>
            <td>Product Price</td>
            <td><input type="float" name="product_price" required></td>
        </tr>
        <tr>
            <td>Product Quantity</td>
            <td><input type="number" name="product_quantity" required></td>
        </tr>
        <tr>
            <td>Product Description</td>
            <td><textarea name="product_description" cols="30" rows="10" required style="resize: vertical;"></textarea></td>
        </tr>
        <tr>
            <td>Publication Status</td>
            <td>
                <select name="publication_status">
                    <option value="1">Published</option>
                    <option value="0">Unpublished</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="btn" value="Save Product Info"></td>
        </tr>
    </table>
</form>-->