<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<link rel="stylesheet" href="/css/user/navigation.css">
<link rel="stylesheet" href="/css/user/category.css">


<body>
    <div class="dashboard">
        <div class="left-dashboard">
            <div class="header">
                <h1>User</h1>
            </div>
            <div class="dashboard-list">
                <ul>
                    <li><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('events.index')}}">Events</a></li>
                    {{-- <li><a href="#">Orders</a></li> --}}
                    <li><a href="{{route('attendes.index')}}">Attendes</a></li>
                    <li><a href="{{route('categories.index')}}">Categories</a></li>
                    {{-- <li><a href="#">Settings</a></li> --}}
                    {{-- <li><a href="#">Roles</a></li> --}}
                    {{-- <li><a href="#">Permissions</a></li> --}}
                    <li><a href="{{route('user.logout')}}">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="right-dashboard">
            <div class="nav">
                <div class="logo">
                    <h1 style="margin:0;padding:0">Event Management System</h1>
                </div>
                <div class="nav-profile">
                    <a href="{{route('user.profile')}}"><img src="/raw/profile.png"></a>
                </div>
            </div>

            @yield('content1')

            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            @yield('scripts')
</body>

</html>
