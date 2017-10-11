<?php

namespace App\classes;
use App\classes\Database;

class Category
{
    protected function queryExecution($sql, $status = NULL) {
        $link = Database::db_connect();
        if (mysqli_query($link, $sql)) {
            if ($status) {
                $queryResult = mysqli_query($link, $sql);
                return $queryResult;
            }
            $message = "Category info saved successfully!!!";
            return $message;
        } else {
            die("Query Problem" . mysqli_error($link));
        }
    }

    public function saveAllCategoryInfo($data) {
        $sql = "INSERT INTO categories (category_name, category_description, publication_status) VALUES ('$data[category_name]', '$data[category_description]', '$data[publication_status]')";
        $message = Category::queryExecution($sql);
        return $message;
    }

    public function getAllCategoryInfo() {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $status = 'select';
        $queryResult = Category::queryExecution($sql, $status);
        return $queryResult;
    }

    public function selectCategoryInfoByCategoryId($categoryId) {
        $sql = "SELECT * FROM categories WHERE id = '$categoryId' ";
        $status = 'select';
        $queryResult = Category::queryExecution($sql, $status);
        return $queryResult;
    }

    public function updateCategoryInfo($data, $categoryId) {
        $sql = "UPDATE categories SET category_name = '$data[category_name]', category_description = '$data[category_description]', publication_status = '$data[publication_status]' WHERE id = '$categoryId' ";
        Category::queryExecution($sql);
        header("Location: view-category.php");

        session_start();
        $updateMessage = "Category ID $categoryId: is updated successfully !!!";
        return $updateMessage;
    }

    public function deleteCategoryinfo($id) {
        $sql = "DELETE FROM categories WHERE id = '$id' ";
        Category::queryExecution($sql);
        session_start();
        $deleteMessage = "Category ID $id: is deleted successfully !!!";
        return $deleteMessage;
    }
    
    public function getAllpublishedCategory() {
        $sql = "SELECT * FROM categories WHERE publication_status = 1 ";
        $link = Database::db_connect();
        if(mysqli_query($link, $sql)) {
           $queryResult = mysqli_query($link, $sql); 
           return $queryResult;
        } else {
            die('Query Problem'.mysqli_error($link));
        }
    }
    


}