<table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th style="width: 30px;">Nombre</th>
                <th style="width: 30px;">Email</th>
                <th style="width: 30px;">Teléfono</th>
                <th style="width: 120px;">Dirección</th>
                <th style="width: 120px;">País</th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">
            @foreach($users as $user)
                <tr>
                    <td>
                        {{ $loop->index + 1 }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->phone }}
                    </td>
                    <td>
                        {{ $user->address }}
                    </td>
                    <td>
                        @if($user->country)
                            {{ $user->country->name }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>