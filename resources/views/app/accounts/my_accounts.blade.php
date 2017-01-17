<!DOCTYPE html>
<html>
<head>
  <title>My Accounts</title>
</head>
<body>
@foreach($accounts as $account)
<div>
  <p>Name: {{ $account->name }}</p>
  <p>Balance: {{ $account->balance_formatted }}</p>
</div>
@endforeach
</body>
</html>
