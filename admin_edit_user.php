<?php

    include_once("conn_db.php");

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    if(isset($id))
    {
        $profile_img="";
        $username="";
        $email="";
        $date="";

        $sql = "SELECT id, username, email, profile_img, created_at FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $userID=$row['id'];
                $profile_img=$row['profile_img'];
                $username=$row['username'];
                $email=$row['email'];
                $date=$row['created_at'];
            }
        }
    }

    class update{

        private $userid;
        private $id;
        private $username; 
        private $email; 
        private $conn;
        private $current_username;
        private $current_email;

        public function __construct($username = "", $email = "", $conn="", $current_username="", $current_email="", $userid=0, $id=0)
        {
            $this->userid=$this->checkInputData($userid);
            $this->id=$this->checkInputData($id);
            $this->username=$this->checkInputData($username);
            $this->email=$this->checkInputData($email);
            $this->current_username=$this->checkInputData($current_username);
            $this->current_email=$this->checkInputData($current_email);
            $this->conn=$conn;

            $this->validateDataAndUpdateUser($this->conn);
        }
    
        public function checkInputData($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function validateDataAndUpdateUser($conn)
        {
            echo "usrID: ".$this->userid;

            if(!empty($this->email))
            {
                if(!empty($this->username))
                {
                    $sql_username = "SELECT * FROM users WHERE username='".$this->username."'";
                    $result5 = mysqli_query($this->conn, $sql_username);
                    $existing_username = mysqli_num_rows($result5);

                    if($this->username === $this->current_username)
                    {
                        // echo "<br>1 username";
                        $sql_email = "SELECT * FROM users WHERE username='".$this->email."'";
                        $result6 = mysqli_query($this->conn, $sql_email);
                        $existing_email = mysqli_num_rows($result6);

                        if($this->email === $this->current_email)
                        {
                            // echo "<br>1 email";
                                $UPDATE="UPDATE users SET `username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. changes were made.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                else
                                {                                   
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Something went wrong.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"aadmin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Something went wrong.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                
                        }
                        else if($existing_email === 0)
                        {
                            // echo "<br>2 email";
                                $UPDATE="UPDATE users SET `username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. changes were made.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                else
                                {                                   
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Something went wrong.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"aadmin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Something went wrong.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                
                        }
                        else if($this->email !== $this->current_email && $existing_email > 0)
                        {
                            // echo "<br>3 email";
                                $UPDATE="UPDATE users SET `username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. changes were made.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                else
                                {                                   
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Something went wrong.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"aadmin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Something went wrong.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                
                        }
                    }
                    else if($existing_username === 0)
                    {
                        // echo "<br>2 username";
                        $sql_email = "SELECT * FROM users WHERE username='".$this->email."'";
                        $result6 = mysqli_query($this->conn, $sql_email);
                        $existing_email = mysqli_num_rows($result6);

                        if($this->email === $this->current_email)
                        {
                            // echo "<br>1 email";
                                $UPDATE="UPDATE users SET `username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. changes were made.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                else
                                {                                   
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Something went wrong.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"aadmin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Something went wrong.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                
                        }
                        else if($existing_email === 0)
                        {
                            // echo "<br>2 email";
                                $UPDATE="UPDATE users SET `username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. changes were made.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                else
                                {                                   
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Something went wrong.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"aadmin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Something went wrong.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                
                        }
                        else if($this->email !== $this->current_email && $existing_email > 0)
                        {
                            // echo "<br>3 email";
                                $UPDATE="UPDATE users SET `username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. changes were made.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                else
                                {                                   
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Something went wrong.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"aadmin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Something went wrong.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                
                        }
                    }
                    else if($this->username !== $this->current_username && $existing_username > 0)
                    {
                        // echo "<br>3 username";
                        $sql_email = "SELECT * FROM users WHERE username='".$this->email."'";
                        $result6 = mysqli_query($this->conn, $sql_email);
                        $existing_email = mysqli_num_rows($result6);

                        if($this->email === $this->current_email)
                        {
                            // echo "<br>1 email";
                                $UPDATE="UPDATE users SET `username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. changes were made.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                else
                                {                                   
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Something went wrong.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"aadmin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Something went wrong.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                
                        }
                        else if($existing_email === 0)
                        {
                            // echo "<br>2 email";
                                $UPDATE="UPDATE users SET `username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. changes were made.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                else
                                {                                   
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Something went wrong.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"aadmin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Something went wrong.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                
                        }
                        else if($this->email !== $this->current_email && $existing_email > 0)
                        {
                            // echo "<br>3 email";
                                $UPDATE="UPDATE users SET `username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. changes were made.\",
                                                            icon: \"icon.png\"
                                                        });
                                                    }
                                                });
                                            }
                                    </script>";
                                }
                                else
                                {                                   
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Something went wrong.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"aadmin_view_user.php?&id={$this->id}&usrID={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Something went wrong.\",
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
                    $this->conn->close();
                    echo "
                    <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Notice,\", {
                                    body: \"Please fill in your username.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"admin_edit_user.php?&id={$this->id}&usrID={$this->userid}\";
                                } else if (Notification.permission !== \"denied\") {
                                    Notification.requestPermission().then(permission => {
                                        if (permission === \"granted\") {
                                            new Notification(\"Notice\", {
                                            body: \"Please fill in your username.\",
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
                $this->conn->close();
                echo "
                <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Notice,\", {
                                body: \"Please fill in your email.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"admin_edit_user.php?&id={$this->id}&usrID={$this->userid}\";
                            } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                        new Notification(\"Notice\", {
                                        body: \"Please fill in your email.\",
                                        icon: \"icon.png\"
                                    });
                                }
                            });
                        }
                </script>";
            }
        }
    }


    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['save-changes']))
    {
        $user_id = $_POST['save-changes'];
        if(isset($user_id))
        {
            // echo "id: " . $id;
            // echo "user id: " . $user_id;

            $sql_usr = "SELECT id, username, email FROM users WHERE id='$user_id'";
            $result_usr = mysqli_query($conn, $sql_usr);
            $row_usr = mysqli_fetch_assoc($result_usr);

            if($row_usr)
            {
                $update = new update($_POST['username'], $_POST['email'], $conn, $row_usr['username'], $row_usr['email'], $user_id, $id);
            }
            else
            {
                echo "
                <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Notice,\", {
                                body: \"Something went wrong.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"admin_edit_user.php?&id={$this->id}&usrID={$user_id}\";
                            } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                        new Notification(\"Notice\", {
                                        body: \"Something went wrong.\",
                                        icon: \"icon.png\"
                                    });
                                }
                            });
                        }
                </script>";
            }
        }

    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['home']))
    {
        $conn->close();
        header("Location: users_table.php?&id=".$id);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['account-profile']))
    {
        $conn->close();
        header("Location: admin_account_profile.php?&id=".$id);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['admin-view-user']))
    {
        $usrID = $_POST['admin-view-user'];

        $conn->close();
        header("Location: admin_view_user.php?&id=".$id."&usrID=".$usrID);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['sign-out']))
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
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluttertask - edit user</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="my_sidebar.css">
    <link rel="stylesheet" href="admin_acount_edit.css">
        
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
                                  <span class="me-2 nav-name" style="font-size: 1rem;"><?php echo $username; ?></span>
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
                                            <span class="me-2" style="font-size: 0.8rem;"><?php echo $username; ?></span>
                                        </div>
                                        <hr class="dropdown-divider">
        
                                        <li><button class="dropdown-item" type="submit" name="home">Return</button></li>
                                        <li><button class="dropdown-item" type="submit" name="account-profile">Profile</button></li>
        
                                        <hr class="dropdown-divider">
                                        <li><button class="dropdown-item" name="sign-out" type="submit">Sign out</button></li>
                                      </form>
                                    </ul>
                                  </div>
                                </div>
                          
                              </div>
                            </nav>
                        </nav>
                        
                        <div class="d-flex flex-column border-0 p-1 ps-3 pe-3">
                            
                            
                            <!-- content -->
                            <div class="card my-card border p-1 pt-1 pb-3 rounded-0 d-flex flex-column justify-content-center align-items-center" style="gap: 1rem;">

                                <form method="POST" class="w-100" enctype="multipart/form-data">
                                    <div class="card-header w-100 d-flex justify-content-center align-items-center bg-white">
                                        EDIT USER
                                    </div>
                                    
                                    <div class="card-body p-0 border-0 w-100 pt-3 pb-3">
    
                                    <?php
                                    
                                            $usrID = mysqli_real_escape_string($conn, $_GET['usrID']);
                                            // echo "user id: ".$usrID;
                                            if(isset($usrID))
                                            {
                                                // echo "hello world";
                                                $usrID = mysqli_real_escape_string($conn, $_GET['usrID']);
                                                $sql_user = "SELECT id, profile_img, username, email, created_at FROM users WHERE id='".$usrID."'";
                                                $result_user = mysqli_query($conn, $sql_user);

                                                if($result_user->num_rows > 0)
                                                {
                                                    while($row = $result_user->fetch_assoc())
                                                    {
                                                        $ID = $row['id'];
                                                        $USERNAME = $row['username'];
                                                        $PROFILE_IMG = $row['profile_img'];
                                                        $DATE = $row['created_at'];
                                                        $EMAIL = $row['email'];

                                                        echo"
                                                            <div class='border-0 d-flex flex-row justify-content-end pe-3'>
                                                                <button type='submit' name='admin-view-user' value='$ID' class='p-1 ps-3 pe-3 rounded-4' style='border: 1px solid #FF0022; background-color: rgba(255, 0, 34, 0.1); color: #FF0022;'>
                                                                    <i class='bi bi-backspace-fill'></i>
                                                                    <span style='color: #FF0022;'>Go back</span>
                                                                </button>
                                                            </div>
                                                            <br>

                                                            <div class='border-0 w-100 pt-3 pb-3 d-flex flex-column justify-content-center align-items-center'>

                                                                    <div class='border d-flex justify-content-center align-items-center' style='overflow: hidden; width: 8rem; height: 8rem; border-radius: 50%;'>
                                                                        <img src='$PROFILE_IMG' alt='...' width='150rem' height='150rem'>
                                                                    </div>

                                                                    <br>

                                                                    <input type='text' name='username' placeholder='Username' value='$USERNAME'>
                                                                    
                                                                    <br>

                                                                    <input type='email' name='email' placeholder='Email' value='$EMAIL'>


                                                                    <br>

                                                                    <button type='submit' name='save-changes' value='$ID' class='border-0 bg-white text-primary'>
                                                                        save changes
                                                                    </button>

                                                            </div>
                                                            
                                                        
                                                        ";

                                                    }
                                                }
                                            }

                                        ?>

                                        </div>
    
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
       
        
</body>
</html>