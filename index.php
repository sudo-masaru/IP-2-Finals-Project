<?php
    session_start();
    include_once("conn_db.php");


    if(isset($_COOKIE['TOKEN']))
    {
        // echo "hello world";
        $getToken = $_COOKIE['TOKEN'];
        $token =(int)$getToken;

        // echo "token: " . $token;

        if(isset($_COOKIE['alwaysLogged']) && $_COOKIE['alwaysLogged']==="true")
        {

            if(str_contains($_POST['email'], "404authadm"))
            {
                $sql = "SELECT token_id, user_id FROM auth_tokens WHERE token_id='$token'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                if(!$row)
                {
                    echo "
                    <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Dear user,\", {
                                body: \"User does not exist.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"index.php\";
                        } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                            new Notification(\"Dear user\", {
                                            body: \"User does not exist.\",
                                            icon: \"icon.png\"
                                        });
                                    }
                                });
                        }
                    </script>";
                }
                else
                {
                    // echo "token exists";
                    $id = $row['user_id'];

                    $sql2 = "SELECT id, username FROM users WHERE id='$id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    
                    if(!$row2)
                    {
                        echo "
                        <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Dear user,\", {
                                    body: \"User does not exist.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"index.php\";
                            } else if (Notification.permission !== \"denied\") {
                                    Notification.requestPermission().then(permission => {
                                        if (permission === \"granted\") {
                                                new Notification(\"Dear user\", {
                                                body: \"User does not exist.\",
                                                icon: \"icon.png\"
                                            });
                                        }
                                    });
                            }
                        </script>";
                    }
                    else
                    {
                        $username = $row2['username'];

                        // echo "hello world ".$username;
                        $conn->close();
                        echo "
                        <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Dear user,\", {
                                    body: \"Welcome back! {$username}.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"admin_dashboard.php?&id={$id}\";
                            } else if (Notification.permission !== \"denied\") {
                                    Notification.requestPermission().then(permission => {
                                        if (permission === \"granted\") {
                                                new Notification(\"Dear user\", {
                                                body: \"Welcome back! {$username}.\",
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
                $sql = "SELECT token_id, user_id FROM auth_tokens WHERE token_id='$token'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                if(!$row)
                {
                    echo "
                    <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Dear user,\", {
                                body: \"User does not exist.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"index.php\";
                        } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                            new Notification(\"Dear user\", {
                                            body: \"User does not exist.\",
                                            icon: \"icon.png\"
                                        });
                                    }
                                });
                        }
                    </script>";
                }
                else
                {
                    // echo "token exists";
                    $id = $row['user_id'];

                    $sql2 = "SELECT id, username FROM users WHERE id='$id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    
                    if(!$row2)
                    {
                        echo "
                        <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Dear user,\", {
                                    body: \"User does not exist.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"index.php\";
                            } else if (Notification.permission !== \"denied\") {
                                    Notification.requestPermission().then(permission => {
                                        if (permission === \"granted\") {
                                                new Notification(\"Dear user\", {
                                                body: \"User does not exist.\",
                                                icon: \"icon.png\"
                                            });
                                        }
                                    });
                            }
                        </script>";
                    }
                    else
                    {
                        $username = $row2['username'];

                        // echo "hello world ".$username;
                        $conn->close();
                        echo "
                        <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Dear user,\", {
                                    body: \"Welcome back! {$username}.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"home.php?&id={$id}\";
                            } else if (Notification.permission !== \"denied\") {
                                    Notification.requestPermission().then(permission => {
                                        if (permission === \"granted\") {
                                                new Notification(\"Dear user\", {
                                                body: \"Welcome back! {$username}.\",
                                                icon: \"icon.png\"
                                            });
                                        }
                                    });
                            }
                        </script>";
                    }

                }
            }
        }
    }
    
    
    class signin{

        private $email;
        private $password;
        private $cookies;
        private $conn;
         
        public function __construct($email="", $password="", $cookies="", $conn="")
        {
            $this->email=$this->checkInputData($email);
            $this->password=$this->checkInputData($password);
            $this->cookies=$this->checkInputData($cookies);
            $this->conn=$conn;

            $this->fetchUserData($this->conn);
        }

        public function checkInputData($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function fetchUserData($conn)
        {
            if(!empty($this->email))
            {
                if(!empty($this->password))
                {
                    $sql = "SELECT * FROM users WHERE email='".$this->email."'";
                    $result = mysqli_query($this->conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    if(!$row)
                    {
                        echo "
                        <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Dear user,\", {
                                    body: \"User does not exist.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"index.php\";
                                } else if (Notification.permission !== \"denied\") {
                                    Notification.requestPermission().then(permission => {
                                        if (permission === \"granted\") {
                                            new Notification(\"Dear user\", {
                                            body: \"User does not exist.\",
                                            icon: \"icon.png\"
                                        });
                                    }
                                });
                            }
                        </script>";
                    }
                    else
                    {
                        $id= $row['id'];
                        $username = $row['username'];

                        // echo "hello world";
                        if(password_verify($this->password, $row['password_hash']))
                        {
                            if(str_contains($this->email, "404authadm"))
                            {
                                if($this->cookies == 365)
                                {
                                    // setcookie("autolog", "true", time()+(86400 * $this->cookies), "/");
                                    // $_SESSION["email"]=$this->email;
                                    // $_SESSION["password"]=$this->password;

                                    // $conn->close();
                                    // header("Location: admin_dashboard.php?id=".$id);
                                    
                                    // $code = rand(100000, 999999);
                                    // $token = (String)$code;

                                    // echo "token: " . $token;

                                    // echo "hello world";

                                        // echo "hello world";
                                    
                                    $code = rand(100000, 999999);
                                    $token = (String)$code;

                                    $sql2="SELECT * FROM auth_tokens WHERE token_id='$token'";
                                    $result2 = mysqli_query($this->conn, $sql2);
                                    $row2 = mysqli_fetch_assoc($result);
                                 
                                    if($row2 > 0)
                                    {
                                        echo "
                                        <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Token already exists.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"index.php\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice,\", {
                                                            body: \"Token already exists.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                        </script>";
                                    }
                                    else
                                    {
                                        // echo "hello world";
                                        $sql3="INSERT INTO `auth_tokens`(token_id, user_id) VALUES ('$token','$id')";
        
                                        $result3 = mysqli_query($this->conn, $sql3);
                                        if($result3===false)
                                        {
                                            echo"<script> alert('Database query failed.') </script>";
                                        }
                                        setcookie("TOKEN", "$token", time()+(86400 * $this->cookies), "/");
                                        setcookie("alwaysLogged", "true", time()+(86400 * $this->cookies), "/");

                                        echo "
                                        <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Welcome back! {$username}.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_dashboard.php?&id={$id}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice,\", {
                                                            body: \"Welcome back! {$username}.\",
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
                                    $code = rand(100000, 999999);
                                    $token = (String)$code;

                                    $sql2="SELECT * FROM auth_tokens WHERE token_id='$token'";
                                    $result2 = mysqli_query($this->conn, $sql2);
                                    $row2 = mysqli_fetch_assoc($result);

                                    if($row2 > 0)
                                    {
                                        echo "
                                        <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Token already exists.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"index.php\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice,\", {
                                                            body: \"Token already exists.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                        </script>";
                                    }
                                    else
                                    {
                                        // echo "hello world";
                                        $sql3="INSERT INTO `auth_tokens`(token_id, user_id) VALUES ('$token','$id')";
        
                                        $result3 = mysqli_query($this->conn, $sql3);
                                        if($result3===false)
                                        {
                                            echo"<script> alert('Database query failed.') </script>";
                                        }
                                        setcookie("TOKEN", "$token", time()+(86400 * $this->cookies), "/");
                                        setcookie("alwaysLogged", "false", time()+(86400 * $this->cookies), "/");

                                        echo "
                                        <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\",\", {
                                                    body: \"Welcome back! {$username}.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_dashboard.php?&id={$id}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\",\", {
                                                            body: \"Welcome back! {$username}.\",
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
                                if($this->cookies == 365)
                                {
                                    // setcookie("autolog", "true", time()+(86400 * $this->cookies), "/");
                                    // $_SESSION["email"]=$this->email;
                                    // $_SESSION["password"]=$this->password;

                                    // $conn->close();
                                    // header("Location: admin_dashboard.php?id=".$id);
                                    
                                    // $code = rand(100000, 999999);
                                    // $token = (String)$code;

                                    // echo "token: " . $token;

                                    // echo "hello world";

                                        // echo "hello world";
                                    
                                    $code = rand(100000, 999999);
                                    $token = (String)$code;

                                    $sql2="SELECT * FROM auth_tokens WHERE token_id='$token'";
                                    $result2 = mysqli_query($this->conn, $sql2);
                                    $row2 = mysqli_fetch_assoc($result);
                                 
                                    if($row2 > 0)
                                    {
                                        echo "
                                        <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Token already exists.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"index.php\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice,\", {
                                                            body: \"Token already exists.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                        </script>";
                                    }
                                    else
                                    {
                                        // echo "hello world";
                                        $sql3="INSERT INTO `auth_tokens`(token_id, user_id) VALUES ('$token','$id')";
        
                                        $result3 = mysqli_query($this->conn, $sql3);
                                        if($result3===false)
                                        {
                                            echo"<script> alert('Database query failed.') </script>";
                                        }
                                        setcookie("TOKEN", "$token", time()+(86400 * $this->cookies), "/");
                                        setcookie("alwaysLogged", "true", time()+(86400 * $this->cookies), "/");

                                        echo "
                                        <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Welcome back! {$username}.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"home.php?&id={$id}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice,\", {
                                                            body: \"Welcome back! {$username}.\",
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
                                    $code = rand(100000, 999999);
                                    $token = (String)$code;

                                    $sql2="SELECT * FROM auth_tokens WHERE token_id='$token'";
                                    $result2 = mysqli_query($this->conn, $sql2);
                                    $row2 = mysqli_fetch_assoc($result);

                                    if($row2 > 0)
                                    {
                                        echo "
                                        <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Token already exists.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"index.php\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice,\", {
                                                            body: \"Token already exists.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                        </script>";
                                    }
                                    else
                                    {
                                        // echo "hello world";
                                        $sql3="INSERT INTO `auth_tokens`(token_id, user_id) VALUES ('$token','$id')";
        
                                        $result3 = mysqli_query($this->conn, $sql3);
                                        if($result3===false)
                                        {
                                            echo"<script> alert('Database query failed.') </script>";
                                        }
                                        setcookie("TOKEN", "$token", time()+(86400 * $this->cookies), "/");
                                        setcookie("alwaysLogged", "false", time()+(86400 * $this->cookies), "/");

                                        echo "
                                        <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\",\", {
                                                    body: \"Welcome back! {$username}.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"home.php?&id={$id}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\",\", {
                                                            body: \"Welcome back! {$username}.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                        </script>";
                                    }

                                }
                            }
                        }
                        else
                        {
                            echo "
                            <script>
                                if (Notification.permission === \"granted\") {
                                    new Notification(\"Dear user,\", {
                                        body: \"Incorrect password.\",
                                        icon: \"icon.png\"
                                    });
                                    window.location.href=\"index.php\";
                                    } else if (Notification.permission !== \"denied\") {
                                        Notification.requestPermission().then(permission => {
                                            if (permission === \"granted\") {
                                                new Notification(\"Dear user\", {
                                                body: \"Incorrect password.\",
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
                    // echo "
                    //     <script>
                    //         new Notification(\"Dear user,\", {
                    //                 body: \"Password must be filled.\",
                    //                 icon: \"icon.png\"
                    //         });
                    //         window.location.href=\"index.php\"
                    //     </script>
                    // ";
                    echo "
                    <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Dear user,\", {
                                body: \"Please enter your password.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"index.php\";
                            } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                        new Notification(\"Dear user\", {
                                        body: \"Please enter your password.\",
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
                        new Notification(\"Dear user,\", {
                            body: \"Please enter your email.\",
                            icon: \"icon.png\"
                        });
                        window.location.href=\"index.php\";
                        } else if (Notification.permission !== \"denied\") {
                            Notification.requestPermission().then(permission => {
                                if (permission === \"granted\") {
                                    new Notification(\"Dear user\", {
                                    body: \"Please enter your email.\",
                                    icon: \"icon.png\"
                                });
                            }
                        });
                    }
                </script>";
            }
        }
    }

    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['sign-in']))
    {
        include_once("conn_db.php");

        if(isset($_POST['remember-me']) )
        {
            $cookies = 365;
            $signin = new signin($_POST['email'], $_POST['password'], $cookies, $conn);
        }
        else
        {
            $cookies = 30;
            $signin = new signin($_POST['email'], $_POST['password'], $cookies, $conn);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlutterTask - Login</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <style>
        @media (min-width: 100px){ .BACKGROUND{display: none;} }
        @media (min-width: 300px){ .BACKGROUND{display: none;} }
        @media (min-width: 750px){ .BACKGROUND{display: none;} }
        @media (min-width: 900px){ .BACKGROUND{display: flex; width: 30rem; } }

        .Logo-txt {
            font-size: 2rem; 
            font-weight: bold;
            background: linear-gradient(to right, #3DE5B1, #42B1F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent; 
            background-clip: text;
            text-fill-color: transparent;
        }

        input{
            height: 2rem;
            border-style: none;
            outline-style: none;
        }

        .INPUT{
            border-bottom: 1px solid #202020;
        }
        .INPUT:focus-within {
            transition: 0.3s ease-in-out;
            border-bottom: 1px solid #42B1F6;
        }

        a{
            text-decoration: none;
        }

    </style>

</head>
<body>

    <div class="container-fluid" style="height: 100vh;">
        <div class="row h-100">
            
            <div class="BACKGROUND col-auto" style="background-image: url('assets/cover.png'); background-repeat: no-repeat; background-size: cover;"> 

                <div class="col d-flex justify-content-center">
                  <div class="container d-flex justify-content-center align-items-center">
                    <img src="assets/hero-img.png" alt="..." width="450rem" height="450rem">
                  </div>
                </div>
      
              </div>

            <div class="FORM col p-3 bg-white" style="box-shadow: 8px 10px 10px 8px rgba(0, 0, 0, 0.205);">
                
                <form method="POST">
                    <div class="col h-100">

                        <div class="col d-flex justify-content-start align-items-center" style="gap: 1rem;">
                            <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;"> <img src="assets/Logo.png" alt="..." width="60rem" height="60rem"> </div>
                            <span class="Logo-txt"> FlutterTask </span>
                        </div>
    
                        <div class="col pt-2 d-flex justify-content-start align-items-center">
                            <span style="font-size: 1rem; opacity: 40%;"> Where Task meets the Flow, Sign-in to maintain tasks. </span>
                        </div>
    
                        <div class="col pt-4 d-flex flex-column" style="gap: 1rem;">
    
                            <div class="INPUT col pt-2 pb-2 d-flex justify-content-start align-items-center">
                                <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;">
                                    <img src="assets/user.png" alt="..." width="20rem" height="20rem">
                                </div>
    
                                <!-- email -->
                                <input type="email" name="email" placeholder="Email" style="width: 100%;">
                            </div>
    
                            <div class="INPUT col pt-2 pb-2 d-flex justify-content-start align-items-center">
                                <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;">
                                    
                                    <!-- Pass lock -->
                                    <button onclick="togglePassword()" type="button" class="d-flex justify-content-center align-items-center" style="border: none; background: none;">
                                        <img id="lock-state" src="assets/lock.png" alt="..." width="20rem" height="20rem">
                                    </button>
                                </div>
    
                                <!-- password -->
                                <input type="password" name="password" placeholder="Password" style="width: 100%;">
                            </div>
                        </div>
    
                        <div class="col pt-3 pb-5 d-flex justify-content-end align-items-center">
                                <span style="font-size: 0.8rem;"> Forgot Pass? <a href="forgot_password_step_1.php"> Click here. </a> </span>
                        </div>
    
                        <div class="col pt-2 pb-2 d-flex justify-content-center align-items-center">
                            <div class="col-auto d-flex justify-content-center align-items-center" style="width: 1.75rem; height: 1.75rem;">
                                
                                <!-- remember me -->
                                <input type="checkbox" name="remember-me" style="width: 0.8rem;">
                            </div>
                            <span style="font-size: 0.8rem;"> Remember me </span>
                        </div>
    
                        <div class="BUTTON col pb-2 d-flex justify-content-center align-items-center">
                            <button type="submit" name="sign-in" style="width: 100%; height: 3rem; border-radius: 8px; background: linear-gradient(to right, #3DE5B1, #42B1F6); color: white; border: none;"> <b> LOGIN </b> </button>
                        </div>
    
                        <div class="col pt-3 pb-5 d-flex justify-content-center align-items-center">
                            <span style="font-size: 0.8rem;"> Don't have an account? <a href="register.php"> register here. </a> </span>
                        </div>
    
                    </div>
                </form>

            </div>

        </div>
    </div>

    <script type="text/javascript">

        let default_lock = "assets/lock.png";
        let open_lock = "assets/unlock.png";
        let pass = document.querySelector("input[type='password']");
        let lock = document.getElementById("lock-state");

        function togglePassword() 
        {
            if(pass.type === "password") 
            {
                pass.type = "text";
                lock.src = open_lock;
            } 
            else 
            {
                pass.type = "password";
                lock.src = default_lock;
            }
        }

    </script>
</body>
</html>