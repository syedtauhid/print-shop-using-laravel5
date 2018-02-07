<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | DGD PRINT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--Add css lib-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @include('user.template._partials.style')
</head>
<body>
<!--Header: Begin-->
@include('user.template._partials.navbar')

<!--Main index : Begin-->
<main class="main">
   @yield('content')
</main>
<!--Footer : Begin-->
@include('user.template._partials.footer')
<div id="sitebodyoverlay"></div>

<!--Add js lib-->
@include('user.template._partials.script')

</body>
</html>
