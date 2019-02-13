@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form id="postForm" method="POST" action="{{ route('creates') }}">
        {{ csrf_field() }}
        <label for="title">Тема:</label><br/>
        <input type="text" name="title" id="title" size="50" value="{{old('title')}}">
        <select name="id_executor" size="1">
            <option value="0">Выберите исполнителя</option>
            @foreach ($executors as $executor)
                <option value= {{$executor['user_id']}}>{{$executor['FIO']}} </option>
            @endforeach
        </select>
        <select name="id_prioriti">

            <option value="">Приоритет:</option>
            <option value="1">1 час</option>
            <option value="2">4 часа</option>
            <option value="3">1 день</option>
            <option value="4">4 дня</option>
            <option value="5">1 неделя</option>
            <option value="6">1 месяц</option>
        </select>
        <br/>
        <label for="text">Текст задачи:</label><br/>
        <textarea type="text" name="text" id="text">{{old('text')}}</textarea>
        <button type="submit">Отправить</button>
    </form>




