<?php 
// including header
include "inc/header.php";

// including classes dynamically
spl_autoload_register(function($class){
  include "classes/".$class.".php";
});
  

?>

<!-- starting body -->
<section class="mainleft">


<?php

// defining variable 
 $user = new Student();

 // on submit "create"
 if (isset($_POST['create'])){
  
// recieving inputs
	$name =$_POST['name']; 
	$dep  =$_POST['dep'];
	$age  =$_POST['age'];
  
// insert into database using methods
	$user->setName($name);
	$user->setDep($dep);
  $user->setAge($age);
  
// on success database insertion
	if($user->insert()){
		echo "<span class='insert'>Data inserted Successfully...</span>";
 }

 } // end of if isset

// on submit "update"
 if (isset($_POST['update'])){
	$id   =$_POST['id'];
	$name =$_POST['name']; 
	$dep  =$_POST['dep'];
	$age  =$_POST['age'];
  
// insert into database using methods
	$user->setName($name);
	$user->setDep($dep);
	$user->setAge($age);
	if($user->update($id)){
		echo "<span class='insert'>Data updated Successfully...</span>";
 }

 } // end of if isset


// on clicking "delete"
 if( isset($_GET['action']) && $_GET['action'] == 'delete'){
	 $id = (int)$_GET['id'];
	 if($user->delete($id)){
		 echo "<span class='insert'>Data Deleted Successfully...</span>";
	 }
 }


// on clicking "update"
 if( isset($_GET['action']) && $_GET['action'] == 'update'){
	 $id = (int)$_GET['id'];
	 $result=$user->readById($id);
?>

<!-- starting form upon condition -->
<form action="" method="post">
 <table>
 <input type="hidden" name="id" value="<?php echo $result['id'];?>"/> 
    <tr>
        <td>Name: </td>
        <td><input type="text" name="name" value="<?php echo $result['name'];?>"required="1"/></td>    
    </tr>

    <tr>
       <td>Department: </td>
        <td><input type="text" name="dep" value="<?php echo $result['dep'];?>"required="1"/></td>
    </tr>

    <tr>
      <td>Age: </td>
        <td><input type="text" name="age" value="<?php echo $result['age'];?>"required="1"/></td>
    </tr>
    <tr>
      <td></td>
        <td>
        <input type="submit" name="update" value="Submit"/>
      </td>
    </tr>
  </table>
</form>

<!-- else condition -->
 <?php } else {?>

<form action="" method="post">
 <table>
    <tr>
        <td>Name: </td>
        <td><input type="text" name="name" required="1"/></td>    
    </tr>

    <tr>
       <td>Department: </td>
        <td><input type="text" name="dep" required="1"/></td>
    </tr>

    <tr>
      <td>Age: </td>
        <td><input type="text" name="age" required="1"/></td>
    </tr>
    <tr>
      <td></td>
        <td>
        <input type="submit" name="create" value="Submit"/>
        <input type="reset" value="Clear"/>
        </td>
    </tr>
  </table>
</form>

 <?php }?>  <!-- condition ends here -->

</section>  <!-- section ends here -->


<!-- another new section for fetching data from database -->
<section class="mainright">
  <table class="tblone">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Department</th>
        <th>Age</th>
        <th>Action</th>
    </tr>

<?php
 $i=0;
// loop through every elements
   foreach ($user->readAll() as $key => $value){
    $i++;
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $value['name'];?></td>
        <td><?php echo $value['dep'];?></td>
        <td><?php echo $value['age'];?></td>
        <td>
		<?php echo "<a href='index.php?action=update&id=".$value['id']."'>Edit</a>";?> ||
        <?php echo "<a href='index.php?action=delete&id=".$value['id']."'onClick='return
		 confirm(\"Are you sure to Delete Data...\")'>Delete</a>";?> 
        </td>
    </tr>

 <?php } ?>
    
  </table>   <!-- table ends here -->

</section>  <!-- section ends here -->








<?php 
// including footer
include "inc/footer.php"; 
?>