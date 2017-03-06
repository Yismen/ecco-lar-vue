<style type="text/css">
    hr {
        font-weight: bold;
    }
    a {
        /*background-color: #abb88e;*/
    }
</style>
<h3>Password Changed</h3>

<h4>{{ $user->name }}</h4>

<p>The admin have changed your password.</p>
<p>Please clike here <a href="{{ url('/admin/login') }}">Dainsys</a></p>
<p>
    <strong>Username:</strong> {{ $user->email }} <br>
    <strong>Password</strong> {{ $password }} <br>
    <small>We strongly recomend to change this password as soon as yo login!</small>
</p>

