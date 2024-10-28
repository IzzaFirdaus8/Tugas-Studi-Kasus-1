<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        ul { list-style-type: none; padding: 0; }
        li { margin: 5px 0; }
        .delete { color: red; }
    </style>
</head>
<body>
    <h1>ToDo List</h1>
    <form action="add_task.php" method="POST">
        <input type="text" name="task" required placeholder="Masukkan kegiatan baru...">
        <button type="submit">Tambah</button>
    </form>

    <h2>Daftar kegiatan</h2>
    <ul>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <li>
                    <?php echo $row['task']; ?>
                    <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="delete">Hapus</a>
                    <a href="edit_task.php?id=<?php echo $row['id']; ?>">Edit</a>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>Tidak ada kegiatan.</li>
        <?php endif; ?>
    </ul>
</body>
</html>

<?php $conn->close(); ?>