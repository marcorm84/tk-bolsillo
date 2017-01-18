<!DOCTYPE html>
<html>
<head>
  <title>Add Account</title>
</head>
<body>
<form method="POST">
  {{ csrf_field() }}
  <input type="text" name="name">
  <select name="currency_id">
  @foreach ($currencies as $currency)
    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
  @endforeach
  </select>
  <input type="text" name="description">
  <select name="type_id">
  @foreach ($account_types as $account_type)
    <option value="{{ $account_type->id }}">{{ $account_type->name }}</option>
  @endforeach
  </select>
  <input type="number" name="balance">
  <button type="submit">Add</button>
</form>
</body>
</html>