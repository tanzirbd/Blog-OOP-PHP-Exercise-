<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
    }

    require '../vendor/autoload.php';
    use App\classes\Category;
    use App\classes\Login;

    $queryResult = Category::getAllCategoryInfo();

    if(isset($_GET['status'])){
        if($_GET['status'] == 'logout') {
            $message = Login::adminLogout();
            $_SESSION['message'] = $message;
        }
    }

    $deleteMessage = '';
    if (isset($_GET['status'])) {
        $id = $_GET['id'];
        $deleteMessage = Category::deleteCategoryinfo($id);
        $_SESSION['deleteMessage'] = $deleteMessage;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Category</title>
    <link href="../assets/admin/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './includes/header.php'; ?>
<div class="container" style="margin-top: 80px;" >
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <h3 class="text-center text-primary">View Category Information</h3>
                    <h3 class="text-center text-success"><?php
                        if (isset($_SESSION['updateMessage'])) {
                            echo $_SESSION['updateMessage'];
                            unset($_SESSION['updateMessage']);
                        }
                        ?>
                    </h3>
                    <h3 class="text-center text-danger"><?php
                        if (isset($_SESSION['deleteMessage'])) {
                        echo $_SESSION['deleteMessage'];
                        unset($_SESSION['deleteMessage']);}
                        ?>
                    </h3>
                    <hr/>

                    <tr class="info text-primary">
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Category Description</th>
                        <th>Publication Status</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($category = mysqli_fetch_assoc($queryResult)) { ?>
                        <tr>
                            <td class="text-center"><?php echo $category['id']; ?></td>
                            <td><?php echo $category['category_name']; ?></td>
                            <td><?php echo $category['category_description']; ?></td>
                            <td><?php echo $category['publication_status'] == 1 ? 'Published' : 'Unpublished'; ?></td>
                            <td>
                                <a href="edit-category.php?id=<?php echo $category['id']; ?>" class="btn btn-info btn-xs">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a href="?status=delete&&id=<?php echo $category['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete Category ID: <?php echo $category['id']; ?>');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../assets/admin/js/bootstrap.min.js"></script>
</body>
</html>


