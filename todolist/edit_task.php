<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id=$id";
    $result = $conn->query($sql);
    $task = $result->fetch_assoc()['task'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST['task'];
    
    $sql = "UPDATE tasks SET task='$task' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
</head>
<body>
    <h1>Edit Tugas</h1>
    <form action="" method="POST">
        <input type="text" name="task" value="<?php echo $task; ?>" required>
        <button type="submit">Perbarui</button>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>