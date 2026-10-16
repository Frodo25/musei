<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Экспонат</title></head>
<body>
    <nav>
        <a href="{{ route('home') }}">Главная</a> |
        <a href="{{ route('about') }}">О музее</a> |
        <a href="{{ route('contacts') }}">Контакты</a> |
        <a href="{{ route('catalog') }}">Каталог</a> |
        <a href="{{ route('exhibits.show', ['id' => 1]) }}">Экспонат №1</a> |
        <a href="{{ route('exhibits.show', ['id' => 2]) }}">Экспонат №2</a> |
        <a href="{{ route('exhibits.show', ['id' => 3]) }}">Экспонат №3</a>
    </nav>
    <h1 id=stroka1>Экспонат №{{ $id }}</h1>
    <p id="stroka2">Подробная информация об историческом экспонате под номером {{ $id }}.</p>
</body>
</html>
<script>
    let a=document.getElementById('stroka1')
    let b=document.getElementById('stroka2')
    if(a.textContent=="Экспонат №1"){
        b.textContent="Это первый экспонат"
    }
    if(a.textContent=="Экспонат №2"){
        b.textContent="Второй жооский"
    }
    if(a.textContent=="Экспонат №3"){
        b.textContent="аура"
    }
</script>