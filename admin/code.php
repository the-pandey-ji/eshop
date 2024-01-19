<?php
session_start();

include("../config/dbcon.php");

include("../functions/myfunctions.php");

if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];  
    $status = isset($_POST['status']) ? '1':'0' ;
    $popular = isset($_POST['popular']) ? '1':'0' ;

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;


    $cate_query = "INSERT INTO categories (name,slug,description,status,popular,image) 
    VALUES ('$name', '$slug', '$description', '$status', '$popular', '$filename')";

    $cate_query_run = mysqli_query($con, $cate_query);
    if($cate_query_run == true)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect("add-category.php","Category Added Successfully");
    }
    else{
        redirect("add-category.php","Something Went Wrong");
    }
}
else if(isset($_POST['update_category_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];  
    $status = isset($_POST['status']) ? '1':'0' ;
    $popular = isset($_POST['popular']) ? '1':'0' ;

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    

    if($new_image != "")
    {   
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
        

    }
    else
    {
        $update_filename = $old_image;
    }
    $path = "../uploads";
    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', image='$update_filename',status='$status', popular='$popular' WHERE id='$category_id'";

    $update_querry_run = mysqli_query($con, $update_query);
    if($update_querry_run == true)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES["image"]["tmp_name"],$path.'/'.$update_filename);
            if(file_exists($path.'/'.$old_image))
            {
                unlink($path.'/'.$old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "Category Updated Successfully");
    }
    else{
        redirect("edit-category.php?id=$category_id", "Something Went Wrong");
    }
}   

else if(isset($_POST['delete_category_btn']))
{

    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_querry = "SELECT * FROM categories WHERE id='$category_id'";
    $cate_query_run = mysqli_query($con, $category_querry);
    $category_data = mysqli_fetch_array($cate_query_run);   
    $image = $category_data['image'];

    $delete_querry = "DELETE FROM categories WHERE id='$category_id'";
    $delete_querry_run = mysqli_query($con, $delete_querry);
    if($delete_querry_run == true)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        redirect("category.php", "Deleted Successfully");
    }
    else
    {
        redirect("category.php", "Something Went Wrong");
    }
}

else if(isset($_POST['add_product_btn']))
{
    $category_id = $_POST['category_id'];

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description']; 
    $original_price = $_POST['original_price']; 
    $selling_price = $_POST['selling_price']; 
    $qty = $_POST['qty']; 
    $status = isset($_POST['status']) ? '1':'0' ;
    $trending = isset($_POST['trending']) ? '1':'0' ;

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if($name != "" && $description != ""  && $slug != ""){


    $product_query = "INSERT INTO products (category_id,name,slug,small_description,description,original_price,selling_price,image,qty,status,trending) 
    VALUES ('$category_id','$name', '$slug', '$small_description','description','$original_price','$selling_price','$filename','$qty', '$status', '$trending')";

    $product_query_run = mysqli_query($con, $product_query);
    if($product_query_run == true)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect("add-product.php","Product Added Successfully");
    }
    else{
        redirect("add-product.php","Something Went Wrong");
    }
    }
    else
    {
        redirect("add-product.php","All Fields are Mandetory");
    }
}

?>