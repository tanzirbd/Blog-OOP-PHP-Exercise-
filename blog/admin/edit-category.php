<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
    }

    require '../vendor/autoload.php';
    use App\classes\Category;
    use App\classes\Login;

    if(isset($_GET['status'])){
        if($_GET['status'] == 'logout') {
            $message = Login::adminLogout();
            $_SESSION['message'] = $message;
        }
    }

    $categoryId = $_GET['id'];
    $queryResult =Category::selectCategoryInfoByCategoryId($categoryId);
    $categoryInfo = mysqli_fetch_assoc($queryResult);

    if (isset($_POST['btn'])) {
        $updateMessage = Category::updateCategoryInfo($_POST, $categoryId);
        $_SESSION['updateMessage'] = $updateMessage;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Category</title>
    <link href="../assets/admin/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './includes/header.php'; ?>
<div class="container"style="margin-top: 80px;" >
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <form class="form-horizontal" action="" method="POST" name="editCategoryForm" >
                <h3 class="text-center text-primary">Edit Category Information</h3>
                <hr/>
                <h3 class="text-center text-success"><?php  ?></h3>

                <div class="form-group">
                    <label for="inputCategoryName" class="col-sm-2 control-label">Category Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="category_name" value="<?php echo $categoryInfo['category_name']; ?>" class="form-control" id="inputCategoryName" placeholder="Category Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCategoryDescription" class="col-sm-2 control-label">Category Description</label>
                    <div class="col-sm-10">
                        <textarea name="category_description" cols="30" rows="10" required style="resize: vertical;"  class="form-control" id="inputCategoryDescription" placeholder="Category Description"><?php echo $categoryInfo['category_description']; ?></textarea>
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
                        <button type="submit" name="btn" class="btn btn-success btn-block">Update Category Info</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../assets/admin/js/bootstrap.min.js"></script>
<script>
    document.forms['editCategoryForm'].elements['publication_status'].value = '<?php echo $categoryInfo['publication_status']; ?>';
</script>
</body>
</html>

