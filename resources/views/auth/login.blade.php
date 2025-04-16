@extends('auth.layout')

@section('content')

<h1>Login</h1>
<br><br>
<form action="{{ route('authenticate') }}" method="post">
    @csrf
    <label>Email</label>
    <br>
    <input type="email" name="email" id="email" value=" {{old('email') }}">
    <br>
    <label>Password</label>
    <br>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="Login">
</form>

@endsection