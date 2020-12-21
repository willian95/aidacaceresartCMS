<table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th style="width: 30px;">Email</th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">
            @foreach($newsletter as $newsletter)
                <tr>
                    <td>
                        {{ $loop->index + 1 }}
                    </td>
                    <td>
                        {{ $newsletter->email }}
                    </td>
                </tr>
            @endforeach
            @foreach($users as $newsletter)
                <tr>
                    <td>
                        {{ $loop->index + 1 }}
                    </td>
                    <td>
                        {{ $newsletter->email }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>