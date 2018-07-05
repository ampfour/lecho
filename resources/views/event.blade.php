<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Event Trigger</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,400,500,700,900|Roboto:400,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" type="text/css" href="css/app.css">

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #dcdcdc;">
        <a class="navbar-brand" href="#">
          <img src="images/TCClogo_320.png" height="30" alt="">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/"><i class="fa fa-home fa-fw"></i> Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/testpage">Test Page</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/calendar"><i class="fa fa-calendar-alt fa-fw"></i> Calendar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/table"><i class="fa fa-list fa-fw"></i> List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/itemcrud"><i class="fa fa-shopping-basket fa-fw"></i> Items</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-cog fa-fw"></i> Settings
            </a>
            <div class="dropdown-menu m-t-5" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/exec_groups/settings">Groups</a>
              <a class="dropdown-item" href="/site/settings">Site Info</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/users/auth/logout"><i class="fa fa-sign-out-alt fa-fw"></i> Logout</a>
            </div>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="d-none d-md-block">
            <div class="inset">
              <img src="https://ampfour.dev/assets/images/members/troy.jpg">
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle p-t-10" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              John Doe            </a>
            <div class="dropdown-menu dropdown-menu-right m-t-5" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#"><i class="fa fa-user-circle fa-fw"></i> Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/users/auth/logout"><i class="fa fa-sign-out-alt fa-fw"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div id="app">
      <h1>Hello, world!</h1>
    </div>

    <script src="js/app.js"></script>
  </body>
</html>
