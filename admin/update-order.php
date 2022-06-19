<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br>
        <br>

        <?php 
        
        //check whether id is set or not
        if(isset($_GET['id']))
        {

        
            //get the order details
            $id=$_GET['id'];
        

            //get all the other details based on this id
            $sql="select * from tbl_order where id=$id";

            //execute the query
            $res=mysqli_query($conn, $sql);


            //count the rows
            $count=mysqli_num_rows($res);
            if($count==1){

                // details available
                $row=mysqli_fetch_assoc($res);
                $food=$row['food'];
                $price=$row['price'];
                $qty=$row['qty'];
                $status=$row['status']; 

                $customer_name=$row['customer_name'];
                $customer_contact=$row['customer_contact'];
                $customer_email=$row['customer_email'];
                $customer_address=$row['customer_address'];
            }


            }
            else{
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-order.php');
            }

            ?>

        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td><b><font color="blue">Food Name</font></b></td>
                <td>
                  <b>  <?php echo $food;?></b>
                </td>
            </tr>
            <tr>
                <td><b><font color="blue">Price</font></b></td>
                <td>
                <b>  ₹ <?php echo $price;?></b>
                </td>
            </tr>
            <tr>
                <td><b><font color="blue">Qty</font></b></td>
                    <td>
                    <input type="number" name="qty" value="<?php echo $qty;?>">
                    </td>
            </tr>
            <tr>
                <td><b><font color="blue">Status</font></b></td>
                    <td>
                    <select name="status">
                        <option <?php if($status=="Ordered"){echo "selected";} ?>value="Oredered">Ordered</option>
                        <option <?php if($status=="On Delivery"){echo "selected";} ?>value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>


                    </select>
                </td>
            </tr>
            <tr>
                <td><b><font color="blue">Customer Name</font></b></td>
                    <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>
            </tr>
            <tr>
                <td><b><font color="blue">Customer Contact</font></b></td>
                    <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
            </tr>
            <tr>
                <td><b><font color="blue">Customer Email</font></b></td>
                    <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                </td>
            </tr>
            <tr>
                <td><b><font color="blue">Customer Addres</font></b></td>
                    <td>
                    <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address;?></textarea> 
                    </td>
            </tr>


            <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">


                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
        </table>
        </form>

        <?php
        //check whether update button is clicked or not
         if(isset($_POST['submit']))
         {
             //  get all the value from form
             $id=$_POST['id'];
             $price=$_POST['price'];
             $qty=$_POST['qty'];
             $total=$price * $qty;
             
             $status=$_POST['status']; 

             $customer_name=mysqli_real_escape_string($conn,$_POST['customer_name']);
             $customer_contact=$_POST['customer_contact'];
             $customer_email=$_POST['customer_email'];
             $customer_address=$_POST['customer_address'];

             //update the values
             $sql2="update tbl_order set
             
             qty=$qty,
             total=$total,
             status='$status',
             customer_name='$customer_name',
             customer_contact='$customer_contact',
             customer_email='$customer_email',
             customer_address='$customer_address'
             where id=$id
             ";
            //execute the query
             $res2=mysqli_query($conn,$sql2);
            //check whether update or not
            //and redirect to manage order with message
            if($res==true)
            {
                //updated
                $_SESSION['update']="<div class='success text-center'>Food Updated Successfully !!.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');

            } 
            else{
                $_SESSION['update']="<div class='error text-center'>Failed to Order Food !!.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
                }
        }


        ?>

    </div>
</div>



<?php include('partials/footer.php'); ?>