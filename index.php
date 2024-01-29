<?php  
    $pdo = new PDO("mysql:host=localhost;dbname=todo",'root',"");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Todo list</title>
</head>
<body>

    <section class="container">
        <?php   
            if(isset($_POST['add'])){
                $task = $_POST['task'];
                $insert = $pdo->prepare("INSERT INTO `task` VALUES (null,?)");
                $insert->execute(array($task));
                header('Location:index.php');
            }  
        ?>
        <form method="post">
            <h1>todolist</h1>
            <input type="text" name="task" placeholder="Adicione uma tarefa">
            <input type="submit" name="add" value="+"> 
        </form>
    </section>

    <section class="task-list">
        <?php
        // excluindo
            if(isset($_GET['del'])){
                $id = $_GET['del'][0];

                $delet = $pdo->prepare("DELETE FROM `task` WHERE id = ?");
                $delet->execute(array($id));
                header('Location:index.php');
            }


        // listando
            $listTask = $pdo->prepare("SELECT * FROM `task`");
            $listTask->execute();
            $listTask = $listTask->fetchAll();

            foreach($listTask as $key => $value){
        ?>
        <div class="task-single">
            <span><?php echo $value['task']; ?></span>
            <a href="?del=<?php echo $value['id']; ?>">excluir</a>
        </div>
        <?php } ?>
    </section>

</body>
</html>