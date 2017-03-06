<h3>Welcome to Dainsys</h3>

<h4>{{ $user->name }}</h4>

<p>We have created an user for you in Dainsys. Please access the following link:</p>
<p>{{ url('/admin/login') }}</p>
<p>
    <strong>Username:</strong> {{ $user->email }} <br>
    <strong>Password</strong> {{ $password }} <br>
    <small>We strongly recomend to change this password as soon as yo login!</small>
</p>