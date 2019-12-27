@php
    $value = data_get($entry, $column['name']);

    // make sure columns are defined
    if (!isset($column['columns'])) {
        $column['columns'] = ['value' => "Value"];
    }

    $columns = $column['columns'];

    // if this attribute isn't using attribute casting, decode it
    if (is_string($value)) {
        $value = json_decode($value);
        //dd($value->ru);
        //$value = $value->ru;
    }


@endphp

<span>
	@if ($value && count($columns))
        <table class="table table-bordered table-condensed table-striped m-b-0">
		<thead>
			<tr>
				@foreach($columns as $tableColumnKey => $tableColumnLabel)
                    <th>{{ $tableColumnLabel }}</th>
                @endforeach
			</tr>
		</thead>
		<tbody>
			@foreach ($value as $tableRow)
                @php
                    $cnt = count($tableRow->values)
                @endphp
                <tr>
				@foreach($columns as $tableColumnKey => $tableColumnLabel)
                    @php

                    @endphp

                    @if( is_object($tableRow) && property_exists($tableRow, $tableColumnKey)  )
                        <td>
                            {{ $tableRow->{$tableColumnKey} }}
                        </td>
                    @else
                        <td>
                            @foreach($tableRow->values as $index => $val)
                                <div>
                                    <div>{{ $val }}</div>
                                    @if($index + 1 != $cnt)
                                        <hr class="w-100">
                                    @endif
                                </div>
                            @endforeach
                        </td>
                    @endif

                @endforeach
			    </tr>
            @endforeach
		</tbody>
	</table>
    @endif
</span>
