<!DOCTYPE html>
<html>
  <head>
    <title>My Account</title>
  </head>
  <body>
    <div>{{ $account->name }}</div>
    <div>{{ $account->currency->name }}</div>
    <div>{{ $account->description }}</div>
    <div>{{ $account->balance_formatted }} </div>
    <div>{{ $account->icon }}</div>
    @foreach($account->collaborators as $collaborator)
      <div>{{ $collaborator->email }}</div>
    @endforeach
    @foreach($account->transactions as $transaction)
      <div>{{ $transaction->type->name }}</div>
      <div>{{ $transaction->amount }}</div>
    @endforeach
  </body>
</html>