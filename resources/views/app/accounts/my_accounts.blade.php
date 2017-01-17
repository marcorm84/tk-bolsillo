<!DOCTYPE html>
<html>
<head>
  <title>My Accounts</title>
</head>
<body>
@foreach($accounts as $account)
<div>
  <p>Name: {{ $account->name }}</p>
  <p>Balance: {{ $account->balance }}</p>
</div>
@endforeach
</body>
</html>