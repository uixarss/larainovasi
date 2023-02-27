<table>
    <thead>
        <tr>
            <th>Timestamp</th>
            <th>ip</th>
            @foreach ($polling->questions as $index => $q)
                <th>{{ $q->question }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($polling->reponses()->distinct()->get(['ip', 'created_at'])
    as $response)
            <tr>
                <td>{{ date('d-m-Y H:i:s a', strtotime($response->created_at)) }}</td>
                <td>{{ $response->ip }}</td>
                @foreach ($polling->questions as $i => $q)
                    @foreach ($optionNames as $opt)
                        @if ($q->id === $opt->question->id)
                            <?php $options[] = $opt->option;
                            $option = implode(', ', $options);
                            ?>
                        @endif
                    @endforeach
                    <td>{{ $option }}</td>
                    <?php $options = []; ?>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
