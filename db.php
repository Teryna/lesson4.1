<?php 
$pdo = new PDO("mysql:host=localhost;dbname=global;charset=utf8",  "JLoseva", "neto1801");
if (!$pdo)
    {
        die('Невозможно подключиться');
    }

$sql = "SELECT * FROM books";

if (empty($_POST['name']) && empty($_POST['author']) && empty($_POST['isbn']) ) {
    if(isset($_SERVER["HTTP_REFERER"])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
    }
}
else {  
$name = $_POST['name'];
$author = $_POST['author'];
$isbn = $_POST['isbn'];
$sql = "SELECT * FROM books WHERE name LIKE '%$name%' AND author LIKE '%$author%' AND isbn LIKE '%$isbn%'";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Реляционные базы данных и SQL</title>
    <link rel="stylesheet" href="css/style.css">  
</head>
<body>
<h1>Библиотека успешного человека</h1>
<div class="search">
    <form method="POST">
        <input type="text" name="isbn" placeholder="ISBN">
        <input type="text" name="name" placeholder="Название">
        <input type="text" name="author" placeholder="Автор">
        <button type="search">Найти</button>
    </form>
</div>
<table>
    <thead>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Автор</th>
            <th>Год выпуска</th>
            <th>ISBN</th>
            <th>Жанр</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pdo->query($sql) as $data) : ?>
            <tr>
                <td><?php echo $data['id'] ?></td>
                <td><?php echo $data['name'] ?></td>
                <td><?php echo $data['author'] ?></td>
                <td><?php echo $data['year'] ?></td>
                <td><?php echo $data['isbn'] ?></td>
                <td><?php echo $data['genre'] ?></td>  
            </tr>
        <?php endforeach; ?>  
    </tbody>
</table>
</body>
</html>