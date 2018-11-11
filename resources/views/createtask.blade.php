

            <form id="postForm"  method="POST" action="{{ route('create') }}" >
                {{ csrf_field() }}
                <label for="title">Тема</label><br />
                <input type="text" name="title" id="title" size="50"><br />
                <label for="text">Текст задачи</label><br />
                <textarea type="text" name="text" id="text" ><br /></textarea>
                <button type="submit">Отправить</button>
            </form>




