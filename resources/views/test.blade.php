{{-- 10 --}}

<form action="/test" method="POST">
    @csrf
    <table>
        <thead>
            <th>name</th>
            <th>booking name</th>
        </thead>
        <tbody>
            @foreach ($booking as $key => $book)
                <tr>
                    <td>
                        {{ $book->staff->first_name . ' ' . $book->staff->last_name }}
                    </td>
                    @php
                        $decode = json_decode($booking[$key]->inventory->attribute);
                    @endphp
                    <td>
                        {{ $decode->model }}
                    </td>
                    <td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button>go</button>
</form>
