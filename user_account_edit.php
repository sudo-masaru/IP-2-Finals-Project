<?php

    include_once("conn_db.php");

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    if(isset($id))
    {
            $profile_img="";
            $username="";
            $email="";

            $sql = "SELECT id, username, email, profile_img, created_at FROM users WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $profile_img=$row['profile_img'];
                    $username=$row['username'];
                    $email=$row['email'];
                    $date=$row['date'];
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
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                    body: \"Update complete. changes were made.\",
                                                    icon: \"icon.png\"
                                                });
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                                window.location.href=\"user_account_profile.php?&id={$this->userid}\";
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
                                window.location.href=\"user_account_edit.php?&id={$this->userid}\";
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
                            window.location.href=\"user_account_edit.php?&id={$this->userid}\";
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
        header("Location: user_account_profile.php?&id=".$id);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['account-settings']))
    {
        $conn->close();
        header("Location: user_account_edit.php?&id=".$id);
    }

    
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['tasks']))
    {
        $conn->close();
        echo" <script> window.location.href=\"home.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['calendar']))
    {
        $conn->close();
        echo" <script> window.location.href=\"calendar.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['files']))
    {
        $conn->close();
        echo" <script> window.location.href=\"files.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['save-changes']))
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
                            window.location.href=\"user_account_profile.php?&id={$user_id}\";
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluttertask - edit profile</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="my_sidebar.css">
    <style>
        .my-main-content{
            overflow-x: auto;
            height: 100vh;
            border-bottom: 8rem;
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

            background-color:rgb(90, 69, 69);
            box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2); 
        }

        .search-bar-column{
            flex-direction: row;
        }


        .list-card{
            border: 1px solid #ffffff;
            background-color:#ffffff;
        }
        .list-card:hover{
            background-color:rgb(247, 247, 247);
            border: 1px solid rgb(247, 247, 247);
        }

        .profile-card{
            flex-direction:row;
        }
        .fg{
            width: 100%;
            height: 20rem;
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
                padding-bottom: 8rem;
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

            .search-bar-column{
                flex-direction: column;
            }

            .content-mobile{
                padding-bottom: 6rem;
            }

            .profile-card{
                flex-direction:column;
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

        .hide-column{
            display: flex;
        }
        @media (max-width: 800px){ 
            .hide-column{
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
                        
                        <div class="d-flex flex-column border-0 ps-3 pe-3" style="gap: 1rem;">
                            
                            <!-- <div class="card p-0 rounded-3 border-0 d-flex justify-content-center align-items-center" style="height: 20rem; overflow: hidden; background-color:rgb(248, 248, 248);">
                                <img src="assets/banner2.jpeg" alt="..." style="width: 20rem height: 20rem;">
                            </div> -->

<!-- content -->
                            <div class="card my-card border p-1 pt-1 pb-3 rounded-0 d-flex flex-column justify-content-center align-items-center" style="gap: 1rem;">

                                <form method="POST" class="w-100" enctype="multipart/form-data">
                                    <div class="card-header w-100 d-flex justify-content-center align-items-center bg-white">
                                        PROFILE
                                    </div>
                                    
                                    <div class="card-body p-0 border-0 w-100 pt-3 pb-3">
    
                                        <div class="border-0 d-flex flex-row justify-content-end pe-3">
                                            <button type="submit" name="profile" value="<?php echo $id; ?>" class="p-1 ps-3 pe-3 rounded-4" style="border: 1px solid #FF0022; background-color: rgba(255, 0, 34, 0.1); color: #FF0022;">
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

                    <br>
                    <br>
                    <br>
                    <br>

                </div>

                <!-- START OF SIDEBAR -->
                <div class="col-auto border my-sidebar bg-light p-0">
                   <form method="POST">

                        <div class="brand border-0 pt-3 pb-3 justify-content-center align-items-center">
                            <img src="assets/Logo.png" alt="..." width="60rem" height="55rem">
                        </div>

                        <button type="submit" title="Dashboard"  value="<?php echo $id; ?>" name="tasks" class="active sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-card-checklist align-self-center"></i>
                            <span> <b>Tasks</b> </span>
                        </button>

                        <button type="submit" title="Users" value="<?php echo $id; ?>" name="calendar" class="inactive sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-calendar-week align-self-center"></i>
                            <span> <b>Calendar</b> </span>
                        </button>

                        <!-- <button type="submit" title="Users" value="<?php echo $id; ?>" name="files" class="inactive sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-file-earmark-fill align-self-center"></i>
                            <span> <b>Files</b> </span>
                        </button> -->

                   </form>
                </div>
                <!-- End OF SIDEBAR -->

            </div>

        </div>

    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
       
        
</body>
</html>