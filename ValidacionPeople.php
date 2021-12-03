<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

switch ($_GET['action']) {
case 'add':
    switch ($_GET['type']) {
    case 'people':
        $error = array();
        $people_fullname = isset($_POST['people_fullname']) ?
            trim($_POST['people_fullname']) : '';
        if (empty($people_fullname)) {
            $error[] = urlencode('Porfavor introduzca un nombre.');
        }
        $is_actor = isset($_POST['is_actor']) ?
            trim($_POST['is_actor']) : '';
        if (empty($is_actor)) {
            $error[] = urlencode('Porfavor selecciona un tipo de actor.');
        }
        $is_director = isset($_POST['is_director']) ?
            trim($_POST['is_director']) : '';
        if (empty($is_director)) {
            $error[] = urlencode('Porvafor selecciona un tipo de director.');
        }
		$email = isset($_POST['email']) ?
            trim($_POST['email']) : '';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error[] = urlencode('Porfavor introduzca un email correcto.');
        }

        if (empty($error)) {
            $query = 'INSERT INTO
                people
                    people_fullname, is_actor, is_director, email
                VALUES
                    ("' . $people_fullname. '",
                     ' . $is_actor . ',
                     ' . $is_director . ',
					  "' . $email . '")';
        } else {
          header('Location:AlejandroRamudoPeople.php?action=add' .
              '&error=' . join(urlencode('<br/>'), $error));
        }
        break;
    }
    break;
case 'edit':
    switch ($_GET['type']) {
    case 'people':
        $error = array();
        $people_fullname = isset($_POST['people_fullname']) ?
            trim($_POST['people_fullname']) : '';
        if (empty($people_fullname)) {
            $error[] = urlencode('Porfavor introduzca un nombre.');
        }
        $is_actor = isset($_POST['is_actor']) ?
            trim($_POST['is_actor']) : '';
        if (empty($is_actor)) {
            $error[] = urlencode('Porfavor selecciona un tipo de actor.');
        }
        $is_director = isset($_POST['is_director']) ?
            trim($_POST['is_director']) : '';
        if (empty($is_director)) {
            $error[] = urlencode('Porfavor selecciona un tipo de director.');
        }

        if (empty($error)) {
            $query = 'UPDATE
                    people
                SET 
                    people_fullname = "' . $people_fullname . '",
                    is_actor = ' . $is_actor . ',
                    is_director = ' . $is_director . ',
                WHERE
                    people_id = ' . $_POST['people_id'];
        } else {
          header('Location:AlejandroRamudoPeople.php?action=edit?&id=' . $_POST['people_id'] .
              '&error=' . join(urlencode('<br/>'), $error));
        }
        break;
    }
    break;
}

if (isset($query)) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
<html>
 <head>
  <title>Commit</title>
 </head>
 <body>
  <p>Done!</p>
 </body>
</html>