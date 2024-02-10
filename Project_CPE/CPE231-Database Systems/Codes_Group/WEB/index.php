<?php include('sever.php');?>

<?php 
    session_start();

    $username = $_SESSION['username'];
    echo("username = $username").'<br />'."\n";

    $find = "SELECT * FROM student WHERE Email = '$username'";
    $query = mysqli_query($conn,$find);
    $result = mysqli_fetch_assoc($query);
    
    $stuid = $result['StuID'];
    echo("STUDENT ID = $stuid");

    $query = "SELECT * FROM find_max_regisid" ;
    $queryregis = mysqli_query($conn,$query);
    $regisID = mysqli_fetch_assoc($queryregis);
    $trueregis = $regisID['MAX(RegisID)'];
    echo(">>>>>>>>>>>>> RegisIDmax = $trueregis");


    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "you must login first";
        header('location: login.php');
    }
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php ');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>home page</title>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>

            <nav>
                <span class="nav-toggle" id="js-nav-toggle">
                    <i class="fas fa-bars"></i>
                </span>
                <div class="logo">
                    <h1>Registration</h1>
                </div>
                <ul id="js-menu">
                    
                    <li><a href="index.php?stuid=<?php echo $stuid; ?>">Home</a></li>
                    <li><a href="grade.php?stuid=<?php echo $stuid; ?>">grade</a></li>
                    <li><a href="registration.php?stuid=<?php echo $stuid; ?>">registration</a></li>
                    <li><a href="timetable.php?stuid=<?php echo $stuid; ?>">class</a></li>
                </ul>
            </nav>


            <script src="script.js"></script>

            <!--   -->
    <div class="header">
        <h2>Home Page</h2>
        <div class="content">
        <!-- notidation message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
    </div>

    

        <!--logged in user information-->
        <?php if (isset($_SESSION['username']))  : ?>
            <p>welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p><a href="login.php?logout='1'" style = "color : red;">logout</a></p>
        <?php endif ?>

    

        
</body>
</html>