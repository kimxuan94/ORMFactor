<?php

    $servername = "localhost";
    $dbname     = "test";
    $dbusername = "root";
    $dbpassword = "";
    $error      = FALSE;
    $result     = FALSE;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $total = $conn->query("SELECT COUNT(id) as rows FROM Posts")
                 ->fetch(PDO::FETCH_OBJ);

        $perpage = 3;
        $posts = $total->rows;
        $pages = ceil($posts / $perpage);

        # default
        $get_pages = isset($_GET['page']) ? $_GET['page'] : 1;

        $data = array(

            'options' => array(
                'default'   => 1,
                'min_range' => 1,
                'max_range' => $pages
                )
        );

        $number = trim($get_pages);
        $number = filter_var($number, FILTER_VALIDATE_INT, $data);
        $range = $perpage * ($number - 1);

        $prev = $number - 1;
        $next = $number + 1;

        $stmt = $conn->prepare("SELECT ID, Title, Author, Content FROM Posts LIMIT :limit, :perpage");
        $stmt->bindParam(':perpage', $perpage, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $range, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll();

    } catch(PDOException $e) {
        $error = $e->getMessage();
    }

    $conn = null;



if(isset($_POST['submit-register'])) {

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql = "INSERT INTO Users (Username, Password)
    VALUES ('$username', '$password')";

    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}




if(isset($_POST['submit-login'])) {
    if(isset($_POST['username'])){

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);

        $sql = "SELECT Password FROM Users WHERE Username = '$username'";
        $result = $conn->query($sql);

        if ($result->rowCount() > 0){
            foreach($result as $row) {
                if ($password == $row['Password']){
                    //echo "Password correct!";
                    header("Location: admin.php");
                }else{
                    header("Location: user-view-page.php");
                }
            }
        }

    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User View Page</title>
        <style type="text/css">

            body {
                font:1rem Arial,sans-serif;
                color:#1a1a1a;
            }

            a {
                text-decoration:none;
                color:#4281A4;
                transition: .3s color;
            }

            a:hover {
                color: #314CB6;
            }

            .error {
                width:100%;
                padding:.5em;
                background-color: #D7F75B;
            }

            .navigation span,
            .navigation a {
                display: inline-block;
                padding:0.5rem;
            }

            #wrap {
                margin:50px auto;
                width: 960px;
            }

            table {
                width:100%;
                border-collapse:collapse;
            }

            th {
                text-align:left;
            }

            tbody > tr:nth-child(odd) {
                background:#f3faf1;
            }

            tbody > tr:nth-child(even) {
                border-top: 1px solid #e5e5e5;
                border-bottom: 1px solid #e5e5e5;
            }

            td:first-child {
                width:25px;
            }

            td:nth-child(3) {
                width:10%;
            }

            thead th,
            tbody td {
                padding:.5rem;
                line-height:1.4rem;
            }

            .top_nav {
                background:#f3faf1;
            }

            #register_message {
            position: absolute;
            z-index:5;
            margin-left:20px;
            margin-top:-16px;
            }

            #login_message {
            z-index:4;
            margin-left:860px;
        margin-top:-15px;
            }

            #register {
            position: absolute;
            z-index:2;
            margin-left:20px;
            }

            #login {
            margin-left:860px;
            }

            h4 {
            margin-left:10px;
            }

        </style>
    </head>
    <body>

        <div class="top_nav">
            <div id="register_message">
            <h3>Register if you are new user!</h3>
            </div>

            <div id="login_message">
            <h3>Login if you have registered before!</h3>
            </div>

            <form method="post" id="register">
        Your Username: <input type="text" name="username"><br>
        Your Password: <input type="text" name="password"><br>
        <input type="submit" name="submit-register" value="Register">
        </form>

        <form method="post" id="login">
        Username: <input type="text" name="username"><br>
        Password : <input type="text" name="password"><br>
        <input type="submit" name="submit-login" value="Log in">
        </form>

        </div>


        <div id="wrap">

            <?php
            if($error)
            {
                echo "<div class=\"error\"><strong>Database Error:</strong> $error</div>";
            }
            ?>

            <?php

                if($result && count($result) > 0)
                {
                    echo '
                    <div class="posts">
                        <h3>Posts</h3>
                        <table>
                    <thead>
                        <tr>
                            <th>ID
                        <th>Title
                        <th>Author
                        <th>Content
                    <tbody>
            ';
                    foreach($result as $key => $row)
                    {
                        echo "
                        <tr>
                            <td>$row[ID]
                            <td>$row[Title]
                        <td>$row[Author]
                        <td>$row[Content]
                        ";
                    }


                    echo '
                    </table>
                </div>
                ';
                }

            ?>

            <div class="navigation">
            <?php

                if($result && count($result) > 0)
                {
                    echo "<h4>Total pages ($pages)</h4>";

                    # first page
                    if($number <= 1)
                        echo "<span>&laquo; prev</span> | <a href=\"?page=$next\">next &raquo;</a>";

                    # last page
                    elseif($number >= $pages)
                        echo "<a href=\"?page=$prev\">&laquo; prev</a> | <span>next &raquo;</span>";

                    # in range
                    else
                        echo "<a href=\"?page=$prev\">&laquo; prev</a> | <a href=\"?page=$next\">next &raquo;</a>";
                }

                else
                {
                    echo "<p>No results found.</p>";
                }

            ?>
            </div>

        </div>

    </body>
</html>
