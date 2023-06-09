<?php 
    $todo = "";
    $error = [];
    $todos = [];

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["todo"]))
    {
        $todo = $_POST["todo"];
        if(isset($_SESSION["todos"]))
        {
            $todos = $_SESSION["todos"];
        }
        if(empty($_POST["todo"]))
        {
            $error["todo"] = "Veuillez entreŕ une tâche";
        }
        else
        {
            $todos[] = $todo;
        }
        $_SESSION["todos"] = $todos;
    }
    if(isset($_GET["delete"]) && isset($_SESSION["todos"]) && is_numeric($_GET["delete"]))
    {
        $delete_index = $_GET["delete"];
        if(array_key_exists($delete_index, $_SESSION["todos"]))
        {
            unset($_SESSION["todos"][$delete_index]);
            $_SESSION["todos"] = array_values($_SESSION["todos"]);
            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form action="" method="post">
        <div class="header">
            <h1>Liste de choses à faire</h1>
            <input 
                name="todo" 
                type="text" 
                id="new-task" 
                placeholder="<?php echo $error["todo"]??"Votre tâche" ?>" 
                class="<?php echo empty($error["todo"])?"":"formError" ?>">
            <button type="submit" id="add-task"><span class="addBtn"> Ajouter</span></button>
        </div>
        <ul id="task-list">
            <?php if(isset($_SESSION["todos"]) && !empty($_SESSION["todos"]))
            {
                foreach ($_SESSION["todos"] as $index => $todo)
                {
                    echo "<li>$todo<a href='?delete=$index' class='close'>&times;</a></li>";
                }
            }
                ?>
        </ul>
    </form>
</body>
</html>