<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
    }

    require '../vendor/autoload.php';
    use App\classes\Blog;
    use App\classes\Login;

    $queryResult = Blog::getAllBlogInfo();
//    while ($row = mysqli_fetch_assoc($queryResult)) {
//        echo '<pre>';
//        print_r($row);
//    }
//    
//    exit();
    
    
    
    
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
                    <h3 class="text-center text-primary">View Blog Information</h3>
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
                        <th>SL No</th>
                        <th>Blog Title</th>
                        <th>Author Name</th>
                        <th>Category Name</th>
                        <th>Publication Status</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                        $i=1;
                        while ($blog = mysqli_fetch_assoc($queryResult)) { ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td><?php echo $blog['blog_title']; ?></td>
                            <td><?php echo $blog['author_name']; ?></td>
                            <td><?php echo $blog['category_name']; ?></td>
                            <td><?php echo $blog['publication_status'] == 1 ? 'Published' : 'Unpublished'; ?></td>
                            <td>
                                <a href="edit-category.php?id=<?php echo $blog['id']; ?>" class="btn btn-primary btn-xs" title="View Blog Details">
                                    <span class="glyphicon glyphicon-zoom-in"></span>
                                </a>
                                <?php if($blog['publication_status'] == 1) { ?>
                                <a href="edit-category.php?id=<?php echo $blog['id']; ?>" class="btn btn-success btn-xs" title="Published">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <?php } else { ?>
                                <a href="edit-category.php?id=<?php echo $blog['id']; ?>" class="btn btn-warning btn-xs" title="Published">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <?php } ?>
                                <a href="edit-category.php?id=<?php echo $blog['id']; ?>" class="btn btn-info btn-xs">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a href="?status=delete&&id=<?php echo $blog['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete Category ID: <?php echo $blog['id']; ?>');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                    <?php  $i++;  } ?>

                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../assets/admin/js/bootstrap.min.js"></script>
</body>
</html>


