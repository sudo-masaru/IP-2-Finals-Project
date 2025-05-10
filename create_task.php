<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluttertask - create task</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="my_sidebar.css">
    <link rel="stylesheet" href="create_task.css">
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

                                    <div class="p-1 card-header bg-white d-flex flex-row justify-content-start align-items-center">

                                        <div class="border-0 w-100 d-flex justify-content-start">
                                            TASK
                                        </div>
                                        <div class="border-0 w-100 d-flex justify-content-end pe-3">
                                            <button type="submit" class="p-1 ps-3 pe-3 rounded-4" style="border: 1px solid #42B1F6; background-color: #42B1F6; color: #ffffff;">
                                                <i class="bi bi-plus-circle"></i>
                                                <span class="text-white btn-txt">New Task</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-header bg-white p-0 pt-2 pb-2 d-flex flex-row">
                                        <div class="border-0 w-100 d-flex flex-row justify-content-start align-items-center">
                                            <div class="border-0 w-50 d-flex justify-content-start align-items-center" style="height: 2rem;">DUE DATE</div>
                                            <div class="border-0 w-100" style="height: 2rem;">
                                                <input type="date" class="w-100 h-100">
                                            </div>
                                        </div>
                                        <div class="card-header-grid-1 border-0 w-100 pt-2 pb-2 justify-content-start align-items-center"></div>
                                        <div class="card-header-grid-2 border-0 w-100 pt-2 pb-2 justify-content-start align-items-center"></div>
                                    </div>

                                    <div class="card-body p-0 pt-3 pb-3 d-flex flex-column justify-content-center align-self-center" style="gap: 1rem;">
                                        
                                        <div class="border" style="height: 3rem;">
                                            <input type="text" placeholder="Title" name="title" class="h-100 w-100 border-0">
                                        </div>

                                        <div class="border" style="height: 3rem;">
                                            <input type="text" placeholder="Description" name="description" class="h-100 w-100 border-0">
                                        </div>

                                        <br>

                                        <div class="border-0" style="height: 3rem;">
                                            <button type="submit" name="create-new-task" class="w-100 h-100 p-0" style="border: 1px solid #42B1F6; background-color: #42B1F6; color: #ffffff;">
                                                Create new task
                                            </button>
                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-auto border my-sidebar bg-light p-0">

                    <div class="brand border-0 pt-3 pb-3 justify-content-center align-items-center">
                        <img src="assets/Logo.png" alt="..." width="60rem" height="55rem">
                    </div>

                    <button title="Task" type="submit" name="redirect-to-task-page" class="inactive sidebar-nav border-0 d-flex justify-content-center">
                        <i class="bi bi-list-task align-self-center"></i>
                    </button>
                    <button title="Calendar" type="submit" name="redirect-to-task-page" class="inactive sidebar-nav border-0 d-flex justify-content-center">
                        <i class="bi bi-calendar-minus align-self-center"></i>
                    </button>

                    <button title="Create new task" type="submit" name="redirect-to-create-task-page" class="active sidebar-nav border-0 d-flex justify-content-center">
                        <i class="bi bi-plus-square align-self-center"></i>
                    </button>
                    

                </div>

            </div>

        </div>

    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
       
        
</body>
</html>