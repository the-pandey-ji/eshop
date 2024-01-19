<?php 
session_start();    

include("includes/header.php"); 

include("../middleware/adminMiddleware.php");

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>

                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <label class = "mb-0" for="">Select Category</label>
                            <select class="form-select mb-2" aria-label="Select Category">
                                <option name = "category_id" selected>Select Category</option>
                                <?php
                                 $query = "SELECT * FROM categories";
                                 $categories = mysqli_query($con,$query);
                                 if(mysqli_num_rows($categories) > 0){
                                 foreach($categories as $category) {
                                 
                                ?>
                                    <option value="<?= $category['id']?>"><?= $category['name'] ?></option>

                                <?php
                                }
                            }
                                else
                                {
                                    echo "No Category Available";
                                }
                                ?>
                                
                               
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class = "mb-0" for="">Name</label>
                            <input type="text" name="name" placeholder="Enter Category Name" class="form-control mb-4">
                        </div>
                        <div class="col-md-6">
                            <label class = "mb-0" for="">Slug</label>
                            <input type="text" name="slug" placeholder="Enter Slug" class="form-control mb-4">
                        </div>
                        <div class="col-md-12">
                            <label class = "mb-0" for="">Small Description</label>
                            <textarea name="small_description" placeholder="Enter Small Description" rows="3" class="form-control mb-4"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class = "mb-0" for="">Description</label>
                            <textarea name="description" placeholder="Enter Description" rows="3" class="form-control mb-4"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class = "mb-0" for="">Original Price</label>
                            <input type="text" name="original_price" placeholder="Enter Original Price" class="form-control mb-4">
                        </div>
                        <div class="col-md-6">
                            <label class = "mb-0" for="">Selling Price</label>
                            <input type="text" name="selling_price" placeholder="Enter Selling Price" class="form-control mb-4">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class = "mb-0" for="">Quantity</label>
                                <input type="number" placeholder="Enter Quantity" name="qty" class="form-control mb-4">
                            </div>
                            <div class="col-md-3">
                                <label class = "mb-0" for="">Status</label> <br>
                                <input type="checkbox" name="status" >
                            </div>
                            <div class="col-md-3">
                                <label class = "mb-0" for="">trending</label><br>
                                <input type="checkbox" name="trending" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class = "mb-0" for="">Upload Image</label>
                            <input type="file" name="image" class="form-control mb-4">
                        </div>
                        
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>