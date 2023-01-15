<?php 
    session_start();
// initialization  
    $task = "";
    $notes = "";
    $id = 0; 
    $edit = false;
    //connection to database
    $con = mysqli_connect('localhost','root','','crud');

    // if save was click
    if(isset($_POST['save']))
    {
        $task = $_POST['task'];
        $notes = $_POST['notes'];

        $query = "INSERT INTO todolist (task,notes) VALUES ('$task','$notes')";
        mysqli_query($con,$query) or die($con->error);
        $_SESSION['message'] =  "A task has been made";
        //redirecting to the index page after the insertion
        header('location: index.php');
    }
     
      //update data
      if(isset($_POST['update']))
      {
          $id = $_POST['id'];
          $task = $_POST['task'];
          $notes = $_POST['notes'];
        
  
          mysqli_query($con, "UPDATE todolist SET task ='$task', notes = '$notes' WHERE id = '$id'");
          $_SESSION['message'] =  "A task has been updated";
          //redirecting to the index page after the updated
          header('location: index.php');
  
      }
      // delete data
      if(isset($_GET['delete']))
      {
          $id = $_GET['delete'];
          mysqli_query($con, "DELETE FROM todolist WHERE id = '$id'");
          $_SESSION['message'] = "A task has been deleted";
          //redirecting to the index page after deleted
          header('location: index.php');
      }
    // retrieve data
    $result = mysqli_query($con,"SELECT * FROM todolist");

?>
