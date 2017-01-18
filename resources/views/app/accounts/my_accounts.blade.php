<!DOCTYPE html>
<html>
<head>
  <title>My Accounts</title>
</head>
<body>
@if (session('message'))
  {{ session('message') }}
@endif

@foreach($accounts as $account)
<div>
  <p>Name: {{ $account->name }}</p>
  <p>Balance: {{ $account->balance_formatted }}</p>
</div>
@endforeach
</body>
</html>
