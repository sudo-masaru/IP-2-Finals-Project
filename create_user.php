<?php
    include_once("conn_db.php");

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    if(isset($id))
    {
            $profile_img="";
            $username="";
            $email="";

            $sql = "SELECT id, username, email, profile_img FROM users WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $profile_img=$row['profile_img'];
                    $username=$row['username'];
                    $email=$row['email'];
                }
            }
    }


    class createuser{
    
        private $userid;
        private $email;
        private $username;
        private $file;
        private $conn;

        public function __construct($userid="", $email="", $username="", $password="", $file="", $conn="")
        {
            $this->userid=$this->checkInputData($userid);
            $this->email=$this->checkInputData($email);
            $this->username=$this->checkInputData($username);
            $this->password=$this->checkInputData($password);
            $this->file=$this->checkInputData($file);
            $this->conn=$conn;

            $this->validateDataAndCreateUser($this->conn);
        }
        public function checkInputData($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        public function validateDataAndCreateUser($conn)
        {
            //    echo "hello world";
            if(!empty($this->email))
            {
                if(!empty($this->username))
                {
                    if($this->username >= 3)
                    {
                        $tmpPass = array("12#qDom2", "qw@rtY23", "CIas&#ic");
                        $index = rand(0, count($tmpPass) - 1);

                        // echo "password: " . $tmpPass[$index];
                        // echo "hello world";

                        $hash=password_hash($index, PASSWORD_DEFAULT);

                        $sql = "SELECT * FROM users WHERE email='".$this->email."'";
                        $result = mysqli_query($conn, $sql);
                        $count_user = mysqli_num_rows($result);
                                                    
                        $sql2 = "SELECT * FROM users WHERE username='".$this->username."'";
                        $result2 = mysqli_query($conn, $sql2);
                        $count_user2 = mysqli_num_rows($result2);

                        if($count_user === 0 && $count_user2 === 0)
                        {
                            $sql3 = "INSERT INTO `users`(id, username, email, password_hash, created_at, profile_img) VALUES (null,'".$this->username."','".$this->email."','$hash',CURRENT_DATE(), '".$this->file."')";
                            $result3 = mysqli_query($conn, $sql3);
                                                    
                            if($result3===false)
                            {
                                echo"<script> alert('Database query failed.') </script>";
                            }
                        
                            $this->conn->close();
                            echo "
                            <script>
                                if (Notification.permission === \"granted\") {
                                    new Notification(\"Notice,\", {
                                        body: \"Account has been added.\",
                                        icon: \"icon.png\"
                                    });
                                    window.location.href=\"users_table.php?&id={$this->userid}\";
                                    } else if (Notification.permission !== \"denied\") {
                                        Notification.requestPermission().then(permission => {
                                            if (permission === \"granted\") {
                                                new Notification(\"Notice\", {
                                                body: \"Account has been added.\",
                                                icon: \"icon.png\"
                                            });
                                        }
                                    });
                                }
                            </script>";

                        }
                        else
                        {
                            echo "
                            <script>
                                if (Notification.permission === \"granted\") {
                                    new Notification(\"Dear user,\", {
                                        body: \"User already exists.\",
                                        icon: \"icon.png\"
                                    });
                                    window.location.href=\"create_user.php?&id={$this->userid}\";
                                    } else if (Notification.permission !== \"denied\") {
                                        Notification.requestPermission().then(permission => {
                                            if (permission === \"granted\") {
                                                new Notification(\"Dear user\", {
                                                body: \"User already exists.\",
                                                icon: \"icon.png\"
                                            });
                                        }
                                    });
                                }
                            </script>";
                        }
                    }
                    else
                    {
                            echo "
                            <script>
                                if (Notification.permission === \"granted\") {
                                    new Notification(\"Notice,\", {
                                        body: \"Username must be atleast 3 or above.\",
                                        icon: \"icon.png\"
                                    });
                                    window.location.href=\"create_user.php?&id={$this->userid}\";
                                    } else if (Notification.permission !== \"denied\") {
                                        Notification.requestPermission().then(permission => {
                                            if (permission === \"granted\") {
                                                new Notification(\"Notice\", {
                                                body: \"Username must be atleast 3 or above.\",
                                                icon: \"icon.png\"
                                            });
                                        }
                                    });
                                }
                            </script>";
                        
                    }
                }
                else
                {
                    echo "
                    <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Notice\", {
                                body: \"Please add an username.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"create_user.php?&id={$this->userid}\";
                            } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                        new Notification(\"Notice\", {
                                        body: \"Please add a username.\",
                                        icon: \"icon.png\"
                                    });
                                }
                            });
                        }
                    </script>";
                }
            }
            else
            {
                echo "
                <script>
                    if (Notification.permission === \"granted\") {
                        new Notification(\"Notice\", {
                            body: \"Please add an email address.\",
                            icon: \"icon.png\"
                        });
                        window.location.href=\"create_user.php?&id={$this->userid}\";
                        } else if (Notification.permission !== \"denied\") {
                            Notification.requestPermission().then(permission => {
                                if (permission === \"granted\") {
                                    new Notification(\"Notice\", {
                                    body: \"Please add an email address.\",
                                    icon: \"icon.png\"
                                });
                            }
                        });
                    }
                </script>";
            }
        }
    }



    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['sign-out']))
    {
        // echo "hello world";

        if(isset($_COOKIE['alwaysLogged']))
        {
            // echo "false";
            if(isset($_COOKIE['TOKEN']))
            {
                $sql = "DELETE FROM auth_tokens WHERE token_id='".$_COOKIE['TOKEN']."'";
                if($conn->query($sql) === TRUE) 
                {
                    setcookie("TOKEN", "", time()+(86400 * 30), "/");
                    setcookie("alwaysLogged", "", time()+(86400 * 30), "/");

                    session_unset();
                    session_destroy();

                    $conn->close();
                    header("Location: index.php");
                } 
                else 
                {
                    // echo "Error deleting record: " . $conn->error;
                        echo "
                        <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Notice,\", {
                                    body: \"Failed to delete token.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"index.php\";
                                } else if (Notification.permission !== \"denied\") {
                                    Notification.requestPermission().then(permission => {
                                        if (permission === \"granted\") {
                                            new Notification(\"Notice,\", {
                                            body: \"Failed to delete token.\",
                                            icon: \"icon.png\"
                                        });
                                    }
                                });
                            }
                        </script>";
                }
            }
        }
        else
        {
            // echo "true";
            $conn->close();
            header("Location: index.php");
        }
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['profile']))
    {
        $conn->close();
        header("Location: admin_account_profile.php?&id=".$id);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['account-settings']))
    {
        $conn->close();
        header("Location: admin_account_edit.php?&id=".$id);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['admin-dashboard']))
    {
        $id = $_POST['admin-dashboard'];

        $conn->close();
        echo" <script> window.location.href=\"admin_dashboard.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['users-table']))
    {
        $id = $_POST['users-table'];

        $conn->close();
        echo" <script> window.location.href=\"users_table.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['create-user']))
    {
        $user_id = mysqli_real_escape_string($conn, $_GET['id']);

        // $createuser = new createuser($user_id, $_POST['email'], $_POST['username'], "w#-H.p13", "file", $conn);

        $file = $_FILES['image'];
        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        // echo "file checking";
        if($_FILES['image']['name']=='')
        {
            $default="gimp-sample.png";
            $uploadDir = "uploads/";
            $destination = $uploadDir . basename($default);

            // echo "default";

            // echo "no world";
            
            $createuser = new createuser($user_id, $_POST['email'], $_POST['username'], "", $destination, $conn);
        }
        else
        {
            // echo "hello world";
            $allowed = array('jpg', 'jpeg', 'jfif', 'png');
            if(in_array($fileActualExt, $allowed))
            {
                if($fileError===0 && $fileSize < 1000000)
                {
                    $uploadDir = "uploads/";
                    $destination = $uploadDir . uniqid() . '-' . basename($fileName);
                        
                    if(move_uploaded_file($fileTmpName, $destination))
                    {
                        $createuser = new createuser($user_id, $_POST['email'], $_POST['username'], "", $destination, $conn);
                    }
                    else
                    {
                        //echo"<script> alert('Failed to move uploaded file!') </script>";
                        echo "Upload error code: " . $_FILES['image']['error'];
                    }
                }
                else
                {
                    echo"<script> alert('There was an error uploading your file!') </script>";
                }
            }
            else
            {
                echo"<script> alert('Not a type of image format!') </script>";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluttertask - create user</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="my_sidebar.css">
    <!-- <link rel="stylesheet" href="admin_dashboard.css"> -->
    <style>

        body{
            overflow: hidden;
        }

        .my-row{
            display: flex;
            flex-direction: row-reverse;
        }

        .my-main-content{
            overflow-x: auto;
            height: 100vh;
        }

        .Logo-txt {
            font-size: 1.25rem; 
            font-weight: bold;
            background: linear-gradient(to right, #3DE5B1, #42B1F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent; 
            background-clip: text;
            text-fill-color: transparent;
        }

        select:focus-within{
            outline-style: none;
        }

        .card-headline{
            display: flex;
        }


        .card-header-grid{
            display: flex;
        }

        .my-card{
            flex-direction: row;
        }

        .sub-card{
            width: 15rem;
            height: 8rem;

            background-color: #ffffff;
            box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2); 
        }

        @media (max-width: 780px){
            .my-row{
                display: flex;
                flex-direction:column;
            }

            .my-main-content
            {
                overflow: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }

            .my-main-content::-webkit-scrollbar 
            {
                display: none;
            }

            select:focus-within{
                outline-style: none;
            }

            .card-headline{
                display: none;
            }

            .card-header-grid-2{
                display: none;
            }

            .my-card{
                flex-direction: column;
            }
        }

        @media (max-width: 600px){ 
            .card-header-grid-1{
                display: none;
            }
        }

        @media (max-width: 500px){ 
            .btn-txt{
                display: none;
            }
        }

    </style>
        
</head>
<body>

        <div class="container-fluid" style="height: 100vh;">
            
            <div class="row my-row h-100">

                <div class="col p-0 my-col-content border-0 d-flex flex-column">
                    
                    

                    <!-- task content -->
                    <div class="my-main-content border-0 d-flex flex-column">

                        <nav class="p-0 navbar navbar-expand navbar-light topbar mb-4 static-top border-bottom" style="background-color: #ffff;">
                            <nav class="navbar bg-body-white p-0 w-100">
                              <div class="container-fluid d-flex justify-content-between align-items-center">
                          
                                <div class="border-0">
                                    <a class="navbar-brand d-flex justify-content-center align-items-center" href="#">
                                        <img src="assets/Logo.png"Logo" width="50rem" height="48rem" class="d-inline-block align-text-top">
                                        <span class="Logo-txt"> FlutterTask </span>
                                    </a>
                                </div>
                          
                                <!-- Profile -->
                                <div class="d-flex align-items-center gap-2">
                                  <span class="me-2 nav-name" style="font-size: 1rem;"> <?php echo $username; ?> </span>
                                  <div class="dropdown">
                                    <button class="btn border-white d-flex justify-content-center align-items-center"
                                      style="overflow: hidden; width: 2.5rem; height: 2.5rem; border-radius: 50%;" type="button"
                                      data-bs-toggle="dropdown" aria-expanded="false">
                                      <img src="<?php echo $profile_img; ?>" alt="..." width="40rem" height="40rem">
                                       
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                      <form method="POST">
        
                                        <div class="col p-2 d-flex flex-column justify-content-center align-items-center" style="gap: 0.8rem;">
                                            <div class="border d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem; overflow: hidden; border-radius: 50%;">
                                                <img src="<?php echo $profile_img; ?>" alt="..." width=35rem" height=35rem">
                                            </div>
                                            <span class="me-2" style="font-size: 0.8rem;"> <?php echo $username; ?> </span>
                                        </div>
                                        <hr class="dropdown-divider">
        
                                        <li><button class="dropdown-item" type="submit" name="profile" value="<?php echo $id; ?>">Profile</button></li>
                                        <li><button class="dropdown-item" type="submit" name="account-settings" value="<?php echo $id; ?>">Account settings</button></li>
        
                                        <hr class="dropdown-divider">
                                        <li><button class="dropdown-item" type="submit" name="sign-out">Sign out</button></li>
                                      </form>
                                    </ul>
                                  </div>
                                </div>
                          
                              </div>
                            </nav>
                        </nav>
                        
                        <div class="d-flex flex-column border-0 p-1">
                            
                            
                            <!-- content -->
                            <div class="card border pt-3 pb-3 ps-2 pe-2 rounded-0">

                                <form method="POST" enctype="multipart/form-data">

                                    <div class="border-0 d-flex flex-row justify-content-end pe-3">
                                        <button type="submit" name="users-table" value="<?php echo $id; ?>" class="p-1 ps-3 pe-3 rounded-4" style="border: 1px solid #FF0022; background-color: rgba(255, 0, 34, 0.1); color: #FF0022;">
                                            <!-- <i class='bi bi-backspace-fill'></i> -->
                                             <i class="bi bi-arrow-return-left"></i>
                                            <span style="color: #FF0022;">Go back</span>
                                        </button>
                                    </div>

                                    <div class="p-1 card-header bg-white d-flex flex-row justify-content-start align-items-center">

                                        <div class="border-0 w-100 d-flex justify-content-start">
                                            USER
                                        </div>
                                    </div>

                                    <div class="card-body p-0 pt-3 pb-3 d-flex flex-column justify-content-center align-self-center" style="gap: 1rem;">
                                       
                                        <div class="border d-flex flex-row" style="height: 3rem;">
                                            <div class="border-0 d-flex justify-content-center align-items-center" style="width: 3rem;">
                                                <i class="bi bi-envelope-at"></i>
                                            </div>
                                            <input type="email" placeholder="Email" name="email" class="h-100 w-100 border-0">
                                        </div>

                                        <div class="border d-flex flex-row" style="height: 3rem;">
                                            <div class="border-0 d-flex justify-content-center align-items-center" style="width: 3rem;">
                                                <img src="assets/user.png" alt="..." width="20rem" height="20rem">
                                            </div>
                                            <input type="text" placeholder="Username" name="username" class="h-100 w-100 border-0">
                                        </div>

                                        <div class="border d-flex flex-row justify-content-center align-items-center" style="height: 3rem;">
                                            <div class="border-0 d-flex justify-content-center align-items-center" style="width: 3rem;">
                                                <img src="assets/user.png" alt="..." width="20rem" height="20rem">
                                            </div>
                                            
                                            <div class="border-0 w-100 d-flex justify-content-center align-items-center" style="width: 3rem;">
                                                <input type="file" placeholder="profile" name="image" class="h-100 w-100 border-0">
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-row justify-content-start align-items-center" style="gap: 0.6rem;">
                                            <i class="bi bi-info-circle" style="font-size: 0.8rem;" title="Automated password is sent to the user's email."></i>
                                            <span> Password is automated </span>
                                        </div>

                                        <br>

                                        <div class="border-0" style="height: 3rem;">
                                            <button type="submit" name="create-user" class="w-100 h-100 p-0" style="border: 1px solid #42B1F6; background-color: #42B1F6; color: #ffffff;">
                                                Create new user
                                            </button>
                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- START OF SIDEBAR -->
                <div class="col-auto border my-sidebar bg-light p-0">
                   <form method="POST">

                        <div class="brand border-0 pt-3 pb-3 justify-content-center align-items-center">
                            <img src="assets/Logo.png" alt="..." width="60rem" height="55rem">
                        </div>

                        <button type="submit" title="Dashboard"  value="<?php echo $id; ?>" name="admin-dashboard" class="inactive sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-speedometer2 align-self-center"></i>
                            <span> <b>Dashboard</b> </span>
                        </button>

                        <button type="submit" title="Users" value="<?php echo $id; ?>" name="users-table" class="active sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-table align-self-center"></i>
                            <span> <b>Users</b> </span>
                        </button>

                   </form>
                </div>
                <!-- End OF SIDEBAR -->

            </div>

        </div>

    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
       
        <script>

            let default_lock = "assets/lock.png";
            let open_lock = "assets/unlock.png";
            
            let pass = document.querySelector("input[name='password']");
            let pslock = document.getElementById("pslock-state");

            function togglePassword() 
            {
                if(pass.type === "password") 
                {
                    pass.type = "text";
                    pslock.src = open_lock;
                } 
                else 
                {
                    pass.type = "password";
                    pslock.src = default_lock;
                }
            }

            let logoutTimer;
            function logoutUser() 
            {
                alert("You have been logged out due to inactivity.");
                window.location.href = 'index.php'; 
            }

            function resetTimer() 
            {
                clearTimeout(logoutTimer);
                logoutTimer = setTimeout(logoutUser, 30 * 60 * 1000); 
            }

            window.onload = resetTimer;
            window.onmousemove = resetTimer;
            window.onkeypress = resetTimer;
            window.onscroll = resetTimer;
            window.onclick = resetTimer;

        </script>
        
</body>
</html>