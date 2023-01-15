<?php include('database.php'); 

// Update the data
    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
        $edit = true;
        $record = mysqli_query($con, "SELECT * FROM todolist WHERE id = $id");
        $getRec = mysqli_fetch_array($record);
        $task = $getRec['task'];
        $notes = $getRec['notes'];
        $id = $getRec['id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel = "stylesheet" type = "text/css" href="style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <div class="size">
        <h1 class = "header">To do list</h1>
    </div>
</head>
<body>
    
    <?php if(isset($_SESSION['message'])): ?>
        <div class="message">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>


    <table>
        <thead>
            <tr>
                <th> Task Name</th>
                <th>Notes</th>
                <th colspan = "2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_array($result))
            {
                ?>
                <tr>
                    <td><?php echo $row['task']; ?></td>
                    <td><?php echo $row['notes']; ?></td>
                    <td>
                        <a class = "edit-button" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
                    </td>
                <td>
                    <a class = "delete-button" href="database.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </td>
                </tr>

                <?php 
            } ?>
            
        </tbody>
    </table>
    <form method= "POST" action = "database.php">
        <input type="hidden" name = "id" value = "<?php echo $id; ?>">
        <div class ="input-group">
            <label> Task Name </label>
            <input type="text" name = "task" value = "<?php echo $task; ?>">
        </div>
            <div class = "input-group">
                <label> Notes </label>
                <input type="text" name = "notes" value = "<?php echo $notes; ?>">
            </div>
                <div class = "input-group">
                    <?php if($edit == false): ?>
                        <button type = "Submit" name = "save" class = "button">Save</button>
                    <?php else: ?>
                        <button type = "Submit" name = "update" class = "button">Update</button>
                    <?php endif ?>
                </div>
    </form>
</body>
</html>
