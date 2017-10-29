<?php

error_reporting(E_ALL);

try {
    $pdo = new PDO ("mysql:host=localhost;dbname=global", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//        $name = $_POST['name_book'];
//        $author = $_POST['author'];
//        $isbn = $_POST['isbn'];
if(!empty($_POST)){
    $name = filter_input(INPUT_POST, 'name_book', FILTER_SANITIZE_STRING);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
    $isbn = filter_input(INPUT_POST, 'isbn', FILTER_VALIDATE_INT);
}

    $sql_get = "SELECT * FROM books WHERE name LIKE '$name%' AND author LIKE '$author%' AND isbn LIKE '$isbn%'";
    $fff = $pdo->query($sql_get);
    $res_get = $fff->fetchAll(PDO::FETCH_ASSOC);

}
catch (PDOException $e){
    echo $e->getMessage();
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Библотека</title>
</head>
<body>
    <h1>Библотека</h1>
<form method="post" style="margin: 20px 0px 20px 0;">
        <input type="text" name="isbn" placeholder="ISBN">
        <input type="text" name="name_book" placeholder="Название книги">
        <input type="text" name="author" placeholder="Автор книги">
        <input type="submit" name="submit" value="Поиск">
</form>

<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>№</th>
        <th>Название</th>
        <th>Автор</th>
        <th>Год выпуска</th>
        <th>Жанр</th>
        <th>ISBN</th>
    </tr>
    <?php foreach ($res_get as $row): ?>
            <tr>
                <td><?=htmlspecialchars($row['id'])?></td>
                <td><?=htmlspecialchars($row['name'])?></td>
                <td><?=htmlspecialchars($row['author'])?></td>
                <td><?=htmlspecialchars($row['year'])?></td>
                <td><?=htmlspecialchars($row['genre'])?></td>
                <td><?=htmlspecialchars($row['isbn'])?></td>
            </tr>
    <?php endforeach; ?>
</table>
</body>


