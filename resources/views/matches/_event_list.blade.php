

<table>
    <thead>
    <tr>
        <th data-field="name">Name</th>
        <th data-field="class">Class</th>
        <th data-field="type">Information</th>
        <th data-field="max_score">Max score</th>
    </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr>
            <td>{{ strtoupper($event->name) }}</td>
            <td>{{ucwords($event->class) }}</td>
            <td>{{ strtoupper($event->type).' ' }}
                {{ $event->gender.' ' }}
                {{ $event->category }}
            </td>

            <td>{{ $event->max_score }}</td>
            <td>
                    <button class=" btn-flat lighten-1"
                            type="submit"
                            name="action"
                            onclick="location.href = '{{ action('eventsController@edit',[$event->id]) }}'"
                            >
                        <i class="material-icons">launch</i>
                    </button>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>