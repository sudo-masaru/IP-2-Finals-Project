<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluttertask - users</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="my_sidebar.css">
    <link rel="stylesheet" href="my_template.css">

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

        .list-txt{
            font-size: 0.8rem;
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
                                        <span class="Logo-txt"> FLutterTask </span>
                                    </a>
                                </div>
                          
                                <!-- Profile -->
                                <div class="d-flex align-items-center gap-2">
                                  <span class="me-2 nav-name" style="font-size: 1rem;">Yanagi Masaru</span>
                                  <div class="dropdown">
                                    <button class="btn border-white d-flex justify-content-center align-items-center"
                                      style="overflow: hidden; width: 2.5rem; height: 2.5rem; border-radius: 50%;" type="button"
                                      data-bs-toggle="dropdown" aria-expanded="false">
                                      <img src="assets/default.png" alt="..." width="40rem" height="40rem">
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                      <form method="POST">
        
                                        <div class="col p-2 d-flex flex-column justify-content-center align-items-center" style="gap: 0.8rem;">
                                            <div class="border d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem; overflow: hidden; border-radius: 50%;">
                                                <img src="assets/default.png" alt="..." width=35rem" height=35rem">
                                            </div>
                                            <span class="me-2" style="font-size: 0.8rem;">Yanagi Masaru</span>
                                        </div>
                                        <hr class="dropdown-divider">
        
                                        <li><button class="dropdown-item" type="submit" name="profile">Profile</button></li>
                                        <li><button class="dropdown-item" type="submit" name="account-settings">Account settings</button></li>
        
                                        <hr class="dropdown-divider">
                                        <li><button class="dropdown-item" type="submit">Sign out</button></li>
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

                                <form method="POST">

                                    <div class="p-1 card-header border-0 bg-white d-flex flex-row justify-content-start align-items-center">

                                        <div class="border-0 w-100 d-flex justify-content-start">
                                            USERS
                                        </div>
                                        <div class="border-0 w-100 d-flex justify-content-end pe-3">
                                            <button type="submit" name="create-new-user" class="p-1 ps-3 pe-3 rounded-4" style="border: 1px solid #42B1F6; background-color: #42B1F6; color: #ffffff;">
                                                <i class="bi bi-person-add"></i>
                                                <span class="text-white btn-txt">New User</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="p-1 card-header bg-white d-flex flex-row justify-content-start align-items-center">

                                        <div class="border-0 w-100 d-flex justify-content-start">
                                            <div class="container-fluid border-0 p-0" style="height: 2rem;">
                                                <input class="form-control me-2 h-100" type="search" placeholder="Search" aria-label="Search"/>
                                            </div>
                                            <button type="submit" class="border-light bg-light" style="font-size: 0.8rem;"><i class="bi bi-search"></i></button>
                                        </div>
                                        <div class="border-0 w-100 d-flex justify-content-end pe-3">
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <i class="bi bi-caret-left-fill"></i>
    
                                                <i class="bi bi-caret-right-fill"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-header d-flex flex-row bg-white">

                                        <div class="sub-card w-100 d-flex justify-content-center"> Username </div>
                                        <div class="sub-card w-100 d-flex justify-content-center"> Email </div>
                                        <div class="sub-card w-100 d-flex justify-content-center"> Action </div>

                                    </div>

                                    <div class="card rounded-0 border-0" style="height: 25em; overflow-y: auto;">

                                        <!-- list -->
                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-bottom pb-3 pt-3 d-flex flex-row bg-white justify-content-center align-items-center">
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">Masaru</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center"> <span class="list-txt">email@email.com</span> </div>
                                            <div class="sub-card w-100 d-flex justify-content-center">
                                                <button type="submit" name="selected-action" class="bg-light border-0" title="Press to operate">
                                                    <i class="bi bi-check-square"></i>
                                                </button>
                                                <div>
                                                    <select name="filter" class="w-100 border-0 bg-light p-1" style="font-size: 0.8rem;">
                                                        <optgroup label="Actions">
                                                            <option value="view">view</option>
                                                            <option value="edit">edit</option>
                                                            <option value="delete">delete</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </form>

                            </div>

                            <br>
                            <br>
                            <br>
                            <br>

                        </div>

                    </div>

                </div>

                <div class="col-auto border my-sidebar bg-light p-0">

                    <div class="brand border-0 pt-3 pb-3 justify-content-center align-items-center">
                        <img src="assets/Logo.png" alt="..." width="60rem" height="55rem">
                    </div>

                    <button title="Dashboard" type="submit" name="redirect-to-task-page" class="inactive sidebar-nav border-0 d-flex flex-column justify-content-center">
                        <i class="bi bi-speedometer2 align-self-center"></i>
                        <span> <b>Dashboard</b> </span>
                    </button>
                    <button title="Users" type="submit" name="redirect-to-task-page" class="active sidebar-nav border-0 d-flex flex-column justify-content-center">
                        <i class="bi bi-table align-self-center"></i>
                        <span> <b>Users</b> </span>
                    </button>
                    

                </div>

            </div>


        </div>

    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
       
        
</body>
</html>