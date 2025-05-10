<?php

    
    class signup{
    
        private $email;
        private $username;
        private $password;
        private $cpassword;
        private $conn="";

        public function __construct($email="",$username="",$password="",$cpassword="",$conn="")
        {
            $this->username=$this->checkInputData($username);
            $this->age=$this->checkInputData($age);
            $this->email=$this->checkInputData($email);
            $this->password=$this->checkInputData($password);
            $this->cpassword=$this->checkInputData($cpassword);
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
            if(!empty($this->email))
            {
                if(!empty($this->username))
                {
                    if(strlen($this->username) >= 3)
                    {
                        if(empty($this->password))
                        {
                            echo "
                            <script>
                                if (Notification.permission === \"granted\") {
                                    new Notification(\"Dear user,\", {
                                        body: \"Pls fill in your password.\",
                                        icon: \"icon.png\"
                                    });
                                    window.location.href=\"register.php\";
                                    } else if (Notification.permission !== \"denied\") {
                                        Notification.requestPermission().then(permission => {
                                            if (permission === \"granted\") {
                                                new Notification(\"Dear user\", {
                                                body: \"Pls fill in your password.\",
                                                icon: \"icon.png\"
                                            });
                                        }
                                    });
                                }
                            </script>";
                        }
                        else if(empty($this->cpassword))
                        {
                            echo "
                            <script>
                                if (Notification.permission === \"granted\") {
                                    new Notification(\"Dear user,\", {
                                        body: \"Pls fill in your password.\",
                                        icon: \"icon.png\"
                                    });
                                    window.location.href=\"register.php\";
                                    } else if (Notification.permission !== \"denied\") {
                                        Notification.requestPermission().then(permission => {
                                            if (permission === \"granted\") {
                                                new Notification(\"Dear user\", {
                                                body: \"Pls fill in your password.\",
                                                icon: \"icon.png\"
                                            });
                                        }
                                    });
                                }
                            </script>";
                        }
                        else
                        {
                            if(!empty($this->password) && !empty($this->cpassword))
                            {
                                if(strlen($this->password) >=8 && strlen($this->cpassword) >= 8)
                                {
                                    if(preg_match('/^(?=.*[A-Z])(?=.*\d).+$/', $this->cpassword))
                                    {
                                        if($this->cpassword === $this->password)
                                        {
                                            $hash = password_hash($this->password, PASSWORD_DEFAULT);

                                            $sql = "SELECT * FROM users WHERE email='".$this->email."'";
                                            $result = mysqli_query($conn, $sql);
                                            $count_user = mysqli_num_rows($result);
                                            
                                            $sql2 = "SELECT * FROM users WHERE username='".$this->username."'";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $count_user2 = mysqli_num_rows($result2);
                
                                            if($count_user === 0 && $count_user2 === 0)
                                            {
                                                $sql3 = "INSERT INTO `users`(id, username, email, password_hash, created_at) VALUES (null,'".$this->username."','".$this->email."','$hash',CURRENT_DATE())";
                                                $result3 = mysqli_query($conn, $sql3);
                                            
                                                if($result3===false)
                                                {
                                                    echo"<script> alert('Database query failed.') </script>";
                                                }
                                                $conn->close();
                                                //header("Location: login.php?message=User+has+been+added+successfully!");

                                                // echo "
                                                //     <script>
                                                //         new Notification(\"Dear user,\", {
                                                //                 body: \"Account has been created.\",
                                                //                 icon: \"icon.png\"
                                                //             });
                                                //         window.location.href=\"index.php\"
                                                //     </script>
                                                // ";
                                                echo "
                                                <script>
                                                    if (Notification.permission === \"granted\") {
                                                        new Notification(\"Dear user,\", {
                                                            body: \"Account has been created.\",
                                                            icon: \"icon.png\"
                                                        });
                                                        window.location.href=\"index.php\";
                                                        } else if (Notification.permission !== \"denied\") {
                                                            Notification.requestPermission().then(permission => {
                                                                if (permission === \"granted\") {
                                                                    new Notification(\"Dear user\", {
                                                                    body: \"Account has been created.\",
                                                                    icon: \"icon.png\"
                                                                });
                                                            }
                                                        });
                                                    }
                                                </script>";
                                            }
                                            else
                                            {
                                                // echo "
                                                //     <script>
                                                //         new Notification(\"Dear user,\", {
                                                //                 body: \"User already exists.\",
                                                //                 icon: \"icon.png\"
                                                //             });
                                                //         window.location.href=\"register.php\"
                                                //     </script>
                                                // ";'
                                                echo "
                                                <script>
                                                    if (Notification.permission === \"granted\") {
                                                        new Notification(\"Dear user,\", {
                                                            body: \"User already exists.\",
                                                            icon: \"icon.png\"
                                                        });
                                                        window.location.href=\"register.php\";
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
                                            // echo "
                                            //     <script>
                                            //         new Notification(\"Dear user,\", {
                                            //                 body: \"Password does not match.\",
                                            //                 icon: \"icon.png\"
                                            //             });
                                            //         window.location.href=\"register.php\"
                                            //     </script>
                                            // ";
                                            echo "
                                            <script>
                                                if (Notification.permission === \"granted\") {
                                                    new Notification(\"Dear user,\", {
                                                        body: \"Password does not match.\",
                                                        icon: \"icon.png\"
                                                    });
                                                    window.location.href=\"register.php\";
                                                    } else if (Notification.permission !== \"denied\") {
                                                        Notification.requestPermission().then(permission => {
                                                            if (permission === \"granted\") {
                                                                new Notification(\"Dear user\", {
                                                                body: \"Password does not match.\",
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
                                        // echo "
                                        //     <script>
                                        //         new Notification(\"Dear user,\", {
                                        //                 body: \"Password must have atleast include capital letter, number and special character.\",
                                        //                 icon: \"icon.png\"
                                        //             });
                                        //         window.location.href=\"register.php\"
                                        //     </script>
                                        // ";
                                        echo "
                                        <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Dear user,\", {
                                                    body: \"Password must include atleast one capital letter, number and special character.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"register.php\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Dear user\", {
                                                            body: \"Password must include atleast one capital letter, number and special character.\",
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
                                    // echo "
                                    //     <script>
                                    //         new Notification(\"Dear user,\", {
                                    //                 body: \"Password must be maximum of 8 characters.\",
                                    //                 icon: \"icon.png\"
                                    //             });
                                    //         window.location.href=\"register.php\"
                                    //     </script>
                                    // ";

                                    echo "
                                    <script>
                                        if (Notification.permission === \"granted\") {
                                            new Notification(\"Dear user,\", {
                                                body: \"Password must be maximum of 8 characters.\",
                                                icon: \"icon.png\"
                                            });
                                            window.location.href=\"register.php\";
                                            } else if (Notification.permission !== \"denied\") {
                                                Notification.requestPermission().then(permission => {
                                                    if (permission === \"granted\") {
                                                        new Notification(\"Dear user\", {
                                                        body: \"Password must be maximum of 8 characters.\",
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
                                // echo "
                                //     <script>
                                //         new Notification(\"Dear user,\", {
                                //                 body: \"Please fill in the password field.\",
                                //                 icon: \"icon.png\"
                                //             });
                                //         window.location.href=\"register.php\"
                                //     </script>
                                // ";
                                echo "
                                    <script>
                                        if (Notification.permission === \"granted\") {
                                            new Notification(\"Dear user,\", {
                                                body: \"Pls fill in your password.\",
                                                icon: \"icon.png\"
                                            });
                                            window.location.href=\"register.php\";
                                            } else if (Notification.permission !== \"denied\") {
                                                Notification.requestPermission().then(permission => {
                                                    if (permission === \"granted\") {
                                                        new Notification(\"Dear user\", {
                                                        body: \"Pls fill in your password.\",
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
                        //             new Notification(\"Dear user,\", {
                        //                     body: \"Username must atleast be 3 to 6 characters minum and maximum.\",
                        //                     icon: \"icon.png\"
                        //                 });
                        //             window.location.href=\"register.php\"
                        //     </script>
                        // ";     

                        echo "
                        <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Dear user,\", {
                                    body: \"Username must atleast be 3 to 6 characters minimum and maximum.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"register.php\";
                                } else if (Notification.permission !== \"denied\") {
                                    Notification.requestPermission().then(permission => {
                                        if (permission === \"granted\") {
                                            new Notification(\"Dear user\", {
                                            body: \"Username must atleast be 3 to 6 characters minimum and maximum.\",
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
                    // echo "
                    //     <script>
                    //             new Notification(\"Dear user,\", {
                    //                     body: \"Pls fill in a username.\",
                    //                     icon: \"icon.png\"
                    //                 });
                    //             window.location.href=\"register.php\"
                    //     </script>
                    // ";
                    echo "
                    <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Dear user,\", {
                                body: \"Pls add your username.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"register.php\";
                            } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                        new Notification(\"Dear user\", {
                                        body: \"Pls add your username.\",
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
                                body: \"Pls add your email.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"register.php\";
                            } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                        new Notification(\"Dear user\", {
                                        body: \"Pls add your email.\",
                                        icon: \"icon.png\"
                                    });
                                }
                            });
                        }
                    </script>";
            }
        }
    }

    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['sign-up']))
    {
        include_once("conn_db.php");

        $signup = new signup($_POST['email'], $_POST['username'], $_POST['password'], $_POST['cpassword'], $conn);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlutterTask - Register</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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
                            <span style="font-size: 1rem; opacity: 40%;"> Where Task meets the Flow, Sign-up to maintain tasks. </span>
                        </div>
    
                        <div class="col pt-4 d-flex flex-column" style="gap: 1rem;">
    
                            <div class="INPUT col pt-2 pb-2 d-flex justify-content-start align-items-center">
                                <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;">
                                    <i class="bi bi-envelope-at"></i>
                                </div>
    
                                <!-- email -->
                                <input type="email" name="email" placeholder="Email" style="width: 100%;">
                            </div>

                            <div class="INPUT col pt-2 pb-2 d-flex justify-content-start align-items-center">
                                <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;">
                                    <img src="assets/user.png" alt="..." width="20rem" height="20rem">
                                </div>
    
                                <!-- username -->
                                <input maxLength="6" type="text" name="username" placeholder="Username" style="width: 100%;">
                            </div>
    
                            <div class="INPUT col pt-2 pb-2 d-flex justify-content-start align-items-center">
                                <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;">
                                    
                                    <!-- Pass lock -->
                                    <button onclick="togglePassword()" type="button" class="d-flex justify-content-center align-items-center" style="border: none; background: none;">
                                        <img id="pslock-state" src="assets/lock.png" alt="..." width="20rem" height="20rem">
                                    </button>
                                </div>
    
                                <!-- password -->
                                <input maxLength="8" type="password" name="password" placeholder="Password" style="width: 100%;">
                            </div>

                            <div class="INPUT col pt-2 pb-2 d-flex justify-content-start align-items-center">
                                <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;">
                                    
                                    <!-- Pass lock -->
                                    <button onclick="toggleCPassword()" type="button" class="d-flex justify-content-center align-items-center" style="border: none; background: none;">
                                        <img id="cslock-state" src="assets/lock.png" alt="..." width="20rem" height="20rem">
                                    </button>
                                </div>
    
                                <!-- password -->
                                <input maxLength="8" type="password" name="cpassword" placeholder="Password" style="width: 100%;">
                            </div>
                        </div>

                        <br>
    
                        <div class="BUTTON col pb-2 d-flex justify-content-center align-items-center">
                            <button type="submit" name="sign-up" style="width: 100%; height: 3rem; border-radius: 8px; background: linear-gradient(to right, #3DE5B1, #42B1F6); color: white; border: none;"> <b> CREATE ACCOUNT </b> </button>
                        </div>
    
                        <div class="col pt-3 pb-5 d-flex justify-content-center align-items-center">
                            <span style="font-size: 0.8rem;"> Already have an account? <a href="index.php"> Login here. </a> </span>
                        </div>
    
                    </div>
                </form>

            </div>

        </div>
    </div>

    <script type="text/javascript">

        let default_lock = "assets/lock.png";
        let open_lock = "assets/unlock.png";
        
        let pass = document.querySelector("input[name='password']");
        let pslock = document.getElementById("pslock-state");

        let cpass = document.querySelector("input[name='cpassword']");
        let cslock = document.getElementById("cslock-state");

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

        function toggleCPassword() 
        {
            if(cpass.type === "password") 
            {
                cpass.type = "text";
                cslock.src = open_lock;
            } 
            else 
            {
                cpass.type = "password";
                cslock.src = default_lock;
            }
        }

    </script>
</body>
</html>