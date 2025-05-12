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

    class update
    {
        private $userid;
        private $username; 
        private $email; 
        private $conn;
        private $file;
        private $current_username;
        private $current_email;

        public function __construct($username = "", $email = "", $conn="", $file="", $current_username="", $current_email="", $userid=0)
        {
            $this->username=$this->checkInputData($username);
            $this->email=$this->checkInputData($email);
            $this->file=$this->checkInputData($file);
            $this->current_username=$this->checkInputData($current_username);
            $this->current_email=$this->checkInputData($current_email);
            $this->userid=$this->checkInputData($userid);
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
            // echo "hello world";
            //echo "email: ".$this->email."<br> username: ".$this->username."<br> profile: ".$this->file;

            if(!empty($this->email))
            {
                if(!empty($this->username))
                {
                    $sql_username = "SELECT * FROM users WHERE username='".$this->username."'";
                    $result5 = mysqli_query($this->conn, $sql_username);
                    $existing_username = mysqli_num_rows($result5);

                    if($this->username === $this->current_username)
                    {
                        // no changes made to username

                        //echo "username !== current_username && existing_username > 0";

                        $sql_email = "SELECT * FROM users WHERE username='".$this->email."'";
                        $result6 = mysqli_query($this->conn, $sql_email);
                        $existing_email = mysqli_num_rows($result6);

                        if($this->email === $this->current_email)
                        {
                            $sql_profile = "SELECT id, profile_img FROM users WHERE id='".$this->userid."'";
                            $result7 = mysqli_query($this->conn, $sql_profile);
                            $current_profile = mysqli_fetch_assoc($result7);

                            if($this-> file === $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. no changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. no changes were made.\",
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                            else if($this-> file !== $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                        else if($existing_email === 0)
                        {
                            $sql_profile = "SELECT id, profile_img FROM users WHERE id='".$this->userid."'";
                            $result7 = mysqli_query($this->conn, $sql_profile);
                            $current_profile = mysqli_fetch_assoc($result7);

                            if($this-> file === $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. no changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. no changes were made.\",
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                            else if($this-> file !== $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                        else if($this->email !== $this->current_email && $existing_email > 0)
                        {
                            $sql_profile = "SELECT id, profile_img FROM users WHERE id='".$this->userid."'";
                            $result7 = mysqli_query($this->conn, $sql_profile);
                            $current_profile = mysqli_fetch_assoc($result7);

                            if($this-> file === $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. no changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. no changes were made.\",
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                            else if($this-> file !== $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                    else if($existing_username === 0)
                    {
                        // no changes made to username

                        //echo "username !== current_username && existing_username > 0";

                        $sql_email = "SELECT * FROM users WHERE username='".$this->email."'";
                        $result6 = mysqli_query($this->conn, $sql_email);
                        $existing_email = mysqli_num_rows($result6);

                        if($this->email === $this->current_email)
                        {
                            $sql_profile = "SELECT id, profile_img FROM users WHERE id='".$this->userid."'";
                            $result7 = mysqli_query($this->conn, $sql_profile);
                            $current_profile = mysqli_fetch_assoc($result7);

                            if($this-> file === $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. no changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. no changes were made.\",
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                            else if($this-> file !== $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                        else if($existing_email === 0)
                        {
                            $sql_profile = "SELECT id, profile_img FROM users WHERE id='".$this->userid."'";
                            $result7 = mysqli_query($this->conn, $sql_profile);
                            $current_profile = mysqli_fetch_assoc($result7);

                            if($this-> file === $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. no changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. no changes were made.\",
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                            else if($this-> file !== $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                        else if($this->email !== $this->current_email && $existing_email > 0)
                        {
                            $sql_profile = "SELECT id, profile_img FROM users WHERE id='".$this->userid."'";
                            $result7 = mysqli_query($this->conn, $sql_profile);
                            $current_profile = mysqli_fetch_assoc($result7);

                            if($this-> file === $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. no changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. no changes were made.\",
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                            else if($this-> file !== $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                    else if($this->username !== $this->current_username && $existing_username > 0)
                    {
                        // no changes made to username

                        //echo "username !== current_username && existing_username > 0";

                        $sql_email = "SELECT * FROM users WHERE username='".$this->email."'";
                        $result6 = mysqli_query($this->conn, $sql_email);
                        $existing_email = mysqli_num_rows($result6);

                        if($this->email === $this->current_email)
                        {
                            $sql_profile = "SELECT id, profile_img FROM users WHERE id='".$this->userid."'";
                            $result7 = mysqli_query($this->conn, $sql_profile);
                            $current_profile = mysqli_fetch_assoc($result7);

                            if($this-> file === $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. no changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. no changes were made.\",
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                            else if($this-> file !== $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                        else if($existing_email === 0)
                        {
                            $sql_profile = "SELECT id, profile_img FROM users WHERE id='".$this->userid."'";
                            $result7 = mysqli_query($this->conn, $sql_profile);
                            $current_profile = mysqli_fetch_assoc($result7);

                            if($this-> file === $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. no changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. no changes were made.\",
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                            else if($this-> file !== $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                        else if($this->email !== $this->current_email && $existing_email > 0)
                        {
                            $sql_profile = "SELECT id, profile_img FROM users WHERE id='".$this->userid."'";
                            $result7 = mysqli_query($this->conn, $sql_profile);
                            $current_profile = mysqli_fetch_assoc($result7);

                            if($this-> file === $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

                                if ($this->conn->query($UPDATE) === TRUE) 
                                {
                                    $this->conn->close();
                                    echo "
                                    <script>
                                            if (Notification.permission === \"granted\") {
                                                new Notification(\"Notice,\", {
                                                    body: \"Update complete. no changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
                                                } else if (Notification.permission !== \"denied\") {
                                                    Notification.requestPermission().then(permission => {
                                                        if (permission === \"granted\") {
                                                            new Notification(\"Notice\", {
                                                            body: \"Update complete. no changes were made.\",
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                            else if($this-> file !== $current_profile['profile_img'])
                            {
                                //echo "profile has not changed <br> current: ".$this->file."<br> old: ". $current_profile['profile_img'];
                                $UPDATE="UPDATE users SET `profile_img`='".$this->file."',`username`='".$this->username."', `email`='".$this->email."' WHERE id='".$this->userid."'";

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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"admin_account_profile.php?&id={$this->userid}\";
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
                                window.location.href=\"admin_account_edit.php?&id={$this->userid}\";
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
                            window.location.href=\"admin_account_edit.php?&id={$this->userid}\";
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
            //echo "id: ".$user_id ."<br> username: ".$_POST['username']."<br> email: ".$_POST['email'];

            $sql3="SELECT id, username, email, profile_img FROM users WHERE id='$user_id'";
            $result3 = mysqli_query($conn, $sql3);
            $row = mysqli_fetch_assoc($result3);

            if(!$row)
            {
                $conn->close();
                echo "
                <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Notice,\", {
                                body: \"Something went wrong.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"account_edit.php?&id={$user_id}\";
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
            else
            {
                $current_profile = $row['profile_img'];

                // echo "fetched";
                $file = $_FILES['image'];
                $fileName = $_FILES['image']['name'];
                $fileTmpName = $_FILES['image']['tmp_name'];
                $fileSize = $_FILES['image']['size'];
                $fileError = $_FILES['image']['error'];
                $fileType = $_FILES['image']['type'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                if($_FILES['image']['name']=='')
                {
                    // $uploadDir = "uploads/";
                    $destination = $current_profile;

                    $update = new update($_POST['username'], $_POST['email'], $conn, $destination, $current_username, $current_email, $id);
                }
                else
                {
                    $allowed = array('jpg', 'jpeg', 'jfif', 'png');
                    if(in_array($fileActualExt, $allowed))
                    {
                        if($fileError===0 && $fileSize < 1000000)
                        {
                            $uploadDir = "uploads/";
                            $destination = $uploadDir . uniqid() . '-' . basename($fileName);
                                
                            if(move_uploaded_file($fileTmpName, $destination))
                            {
                                $update = new update($_POST['username'], $_POST['email'], $conn, $destination, $current_username, $current_email, $id);
                            }
                            else
                            {
                                echo"<script> alert('Your file is too big!') </script>";
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


        }

    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['home']))
    {
        $conn->close();
        header("Location: admin_dashboard.php?&id=".$id);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['account-profile']))
    {
        $conn->close();
        header("Location: admin_account_profile.php?&id=".$id);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluttertask - account settings</title>
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
        
                                        <li><button class="dropdown-item" type="submit" name="home">Home</button></li>
                                        <li><button class="dropdown-item" type="submit" name="account-profile">Profile</button></li>
        
                                        <hr class="dropdown-divider">
                                        <li><button class="dropdown-item" type="submit">Sign out</button></li>
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
                                        PROFILE
                                    </div>
                                    
                                    <div class="card-body p-0 border-0 w-100 pt-3 pb-3">
    
                                        <div class="border-0 d-flex flex-row justify-content-end pe-3">
                                            <button type="submit" name="account-profile" value="<?php echo $id; ?>" class="p-1 ps-3 pe-3 rounded-4" style="border: 1px solid #FF0022; background-color: rgba(255, 0, 34, 0.1); color: #FF0022;">
                                                <i class="bi bi-backspace-fill"></i>
                                                <span style="color: #FF0022;">Go back</span>
                                            </button>
                                        </div>
                                        <br>

                                        <div class="border-0 w-100 pt-3 pb-3 d-flex flex-column justify-content-center align-items-center">

                                            <?php
                                            
                                                $usrID = mysqli_real_escape_string($conn, $_GET['id']);
                                                    // echo "id: ".$usrID; 
                                                $sql4="SELECT id, username, email, profile_img FROM users WHERE id='$usrID'";
                                                $result4 = mysqli_query($conn, $sql4);
                                                
                                                if(mysqli_num_rows($result4) > 0)
                                                {
                                                    while($row = $result4->fetch_assoc())
                                                    {
                                                        $usr_id=$row['id'];
                                                        $username=$row['username'];
                                                        $email=$row['email'];
                                                        $profile_img=$row['profile_img'];

                                                        // echo "hello world";
                                                        echo"
                                                        
                                                            <div class='border d-flex justify-content-center align-items-center' style='overflow: hidden; width: 8rem; height: 8rem; border-radius: 50%;'>
                                                                <img src='$profile_img' alt='...' width='150rem' height='150rem'>
                                                            </div>

                                                            <br>

                                                            <div class='d-flex flex-column justify-content-start'>
                                                                <span> Change image </span>
                                                                <input type='file' name='image' value='$profile_img'>
                                                            </div>

                                                            <br>

                                                            <input type='text' name='username' placeholder='Username' value='$username'>
                                                            
                                                            <br>

                                                            <input type='email' name='email' placeholder='Email' value='$email'>

                                                            <br>
                                                            
                                                            <button type='submit' name='change-password' value='$usr_id' class='border-0 bg-white' style='text-decoration: underline;'>
                                                                change your password
                                                            </button>

                                                            <br>

                                                            <button type='submit' name='save-changes' value='$usr_id' class='border-0 bg-white text-primary'>
                                                                save changes
                                                            </button>
                                                        
                                                        ";
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