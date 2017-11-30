<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Code</title>
</head>
<body>
  <ul>
    @foreach($codes as $code)
      <li>
        {{ $code->token }}
        -
        @if($code->confirmed)
          Used
        @else
          Unused
        @endif
      </li>
    @endforeach
  </ul>
</body>
</html>