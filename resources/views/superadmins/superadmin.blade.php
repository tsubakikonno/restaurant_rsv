<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/superadmin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table class="manager_crud">

    @foreach($managers as $manager)
    <tr><th class="manager_ttl">Restaurant</th>
    <th class="manager_ttl">Email</th>
    <th class="manager_ttl">restaurant_id</th>
    <th class="manager_ttl">Password</th></tr>

<tr>
<form action="{{ route('superadminEdit') }}" method="post">

<td class="manager_edit"><input type="text" name="name" value="{{ $manager->name }}" class="input_edit"></td>
<td class="manager_edit"><input type="email" name="email" value="{{ $manager->email }}" class="input_edit"></td>
<td class="manager_edit"><input type="text" name="restaurant_id" value="{{ $manager->restaurant_id }}" class="input_edit"></td>
<td class="manager_edit"><input type="password" name="password"  value="{{ $manager->password }}" class="input_edit"></td>
<td class="manager_edit"><input type="hidden" name="id"  value="{{ $manager->id }}"></td>
      @csrf
      <td class="manager_btn"><button class="update">更新</button></td>
</form>
<form action="{{ route('superadminDelete') }}" method="post">
      @csrf
<input type="hidden" name="id" value="{{ $manager->id }}"></td>
<td class="manager_btn"><button class="delete">削除</button>
</td></form>
@endforeach
</tr>
    </table>
    <div class="manager_crt">
        <h1>作成</h1>
 <form action="{{ route('superadminCreate') }}" method="post">
    @csrf
    <p><input type="text" name="name" value="{{ old('name') }}" class="input_crt" placeholder ="Restaurant"></p>
    <p><input type="email" name="email" value="{{ old('email') }}" class="input_crt" placeholder ="Email"></p>
    <p><input type="number" name="restaurant_id" value="{{ old('restaurant_id') }}" class="input_crt" placeholder ="restaurant_id"></p>
    <p><input type="password" name="password"  value="{{ old('password') }}" class="input_crt" placeholder ="Password"></p>
    <p><input type="hidden" name="id"  value="{{ $manager->id }}"></p>
    
   
      <button class="create">作成する</button>
      </form>
    </div>

    <form action="{{ route('superadminsdestroy') }}" method="post">
        @csrf
<button>ログアウト</button>
</form>
</body>
</html>