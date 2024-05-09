<!doctype html>
<html lang="en">
<head>
   @include('includes.head')
</head>
<body data-sidebar="dark" data-layout-mode="light">
<div id="layout-wrapper">
    <header id="page-topbar">
       @include('includes.header')
    </header>
    <div id="menu-sidbar" class="vertical-menu">
        @include('includes.sidebar')
    </div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            @include('includes.footer')
        </footer>
    </div>
</div>
@include('includes.scripts')
</body>
</html>