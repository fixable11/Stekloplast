<!-- Backpack Table Field Type -->

<?php
$max = isset($field['max']) && (int) $field['max'] > 0 ? $field['max'] : -1;
$min = isset($field['min']) && (int) $field['min'] > 0 ? $field['min'] : -1;
$item_name = strtolower(isset($field['entity_singular']) && ! empty($field['entity_singular']) ? $field['entity_singular'] : $field['label']);

$items = old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '';
//$items = json_decode($items)->{app()->getLocale()};
// make sure not matter the attribute casting
// the $items variable contains a properly defined JSON string
if (is_array($items)) {
    if (count($items)) {
        $items = json_encode($items);
    } else {
        $items = '[]';
    }
} elseif (is_string($items) && ! is_array(json_decode($items))) {
    $items = '[]';
}

// make sure columns are defined
if (! isset($field['columns'])) {
    $field['columns'] = ['value' => 'Value'];
}
?>
<div data-field-type="table" data-field-name="{{ $field['name'] }}" @include('crud::inc.field_wrapper_attributes') >

    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    <input class="array-json"
           type="hidden"
           data-init-function="bpFieldInitTableElement"
           name="{{ $field['name'] }}">

    <div class="array-container form-group">

        <table class="table table-sm table-striped m-b-0" data-items="{{ $items }}" data-max="{{$max}}" data-min="{{$min}}" data-maxErrorTitle="{{trans('backpack::crud.table_cant_add', ['entity' => $item_name])}}" data-maxErrorMessage="{{trans('backpack::crud.table_max_reached', ['max' => $max])}}">

            <thead>
            <tr>
                @foreach( $field['columns'] as $column )
                    <th style="font-weight: 600!important;">
                        {{ $column }}
                    </th>
                @endforeach
                <th class="text-center"> {{-- <i class="fa fa-sort"></i> --}} </th>
                <th class="text-center"> {{-- <i class="fa fa-trash"></i> --}} </th>
            </tr>
            </thead>

            <tbody class="table-striped items sortableOptions">

            <input style="display: none" class="cloneInput mt-2 form-control form-control-sm val" type="text" data-name="item.values">

            <tr class="array-row clonable" style="display: none;">
                @php
                    $i = 0;
                @endphp
                @foreach( $field['columns'] as $column => $label)
                    <td @if($i%2 != 0) class="cloneInputTo" @endif>
                        <input
                            class="mt-2 form-control form-control-sm @if($i%2 != 0) val @else key @endif"
                            type="text"
                            data-name="item.{{ $column }}"
                        >
                    </td>
                    @php
                        $i++;
                    @endphp
                @endforeach
                <td>
                    <div class="">
                        <button class="mt-1 btn btn-sm btn-light addSubItem" type="button" data-button-type="addSubItem"><i class="fa fa-plus"></i></button>
                        <button class="mt-1 removeSubItem btn btn-sm btn-light" type="button" data-button-type="removeSubItem"><i class="fa fa-minus"></i></button>
                        <span class="mt-1 btn btn-sm btn-light sort-handle pull-right "><span class="sr-only">sort item</span><i class="fa fa-sort" role="presentation" aria-hidden="true"></i></span>
                    </div>
                </td>
                <td>
                    <button class=" mt-2 btn btn-sm btn-light removeItem" type="button"><span class="sr-only">delete item</span><i class="fa fa-trash" role="presentation" aria-hidden="true"></i></button>
                </td>
            </tr>

            </tbody>

        </table>

        <div class="array-controls btn-group m-t-10">
            <button class="btn btn-sm btn-light" type="button" data-button-type="addItem"><i class="fa fa-plus"></i> {{trans('backpack::crud.add')}} {{ $item_name }}</button>
        </div>

    </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        {{-- YOUR JS HERE --}}
        <script type="text/javascript" src="{{ asset('packages/jquery-ui-dist/jquery-ui.min.js') }}"></script>

        <script>
            function bpFieldInitTableElement(element) {
                var $tableWrapper = element.parent('[data-field-type=table]');

                var $max = $tableWrapper.find('table').attr('data-max');
                var $min = $tableWrapper.find('table').attr('data-min');

                var $maxErrorTitle = $tableWrapper.find('table').attr('data-maxErrorTitle');
                var $maxErrorMessage = $tableWrapper.find('table').attr('data-maxErrorMessage');

                var $rows = $.parseJSON($tableWrapper.find('table').attr('data-items'));

                // add rows with the information from the database
                if($rows != '[]') {
                    $.each($rows, function(key) {

                        addItem();

                        $.each(this, function(column , value) {
                            if (Array.isArray(value)) {
                                var inp = $tableWrapper.find('tbody tr:last').find('input[data-name="item.' + column + '"]');
                                $.each(value, function (col, val) {
                                    inp.before(inp.clone().val(val));
                                });
                                inp.remove();
                            } else {
                                $tableWrapper.find('tbody tr:last').find('input[data-name="item.' + column + '"]').val(value);
                            }
                        });

                        // if it's the last row, update the JSON
                        if ($rows.length == key+1) {
                            updateTableFieldJson();
                        }
                    });
                }

                // add minimum rows if needed
                var itemCount = $tableWrapper.find('tbody tr').not('.clonable').length;
                if($min > 0 && itemCount < $min) {
                    $rowsToAdd = Number($min) - Number(itemCount);

                    for(var i = 0; i < $rowsToAdd; i++){
                        addItem();
                    }
                }

                $tableWrapper.find('.sortableOptions').sortable({
                    handle: '.sort-handle',
                    axis: 'y',
                    helper: function(e, ui) {
                        ui.children().each(function() {
                            $(this).width($(this).width());
                        });
                        return ui;
                    },
                    update: function( event, ui ) {
                        updateTableFieldJson();
                    }
                });


                $tableWrapper.find('[data-button-type=addItem]').click(function() {
                    if($max > -1) {
                        var totalRows = $tableWrapper.find('tbody tr').not('.clonable').length;

                        if(totalRows < $max) {
                            addItem();
                            updateTableFieldJson();
                        } else {
                            new Noty({
                                type: "warning",
                                text: "<strong>"+$maxErrorTitle+"</strong><br>"+$maxErrorMessage
                            }).show();
                        }
                    } else {
                        addItem();
                        updateTableFieldJson();
                    }
                });

                $tableWrapper.on('click', '.addSubItem', function() {
                    addSubItem($(this));
                    updateTableFieldJson();
                });

                $tableWrapper.on('click', '.removeSubItem', function() {
                    removeSubItem($(this));
                    updateTableFieldJson();
                    // var totalRows = $tableWrapper.find('tbody tr').not('.clonable').length;
                    // if (totalRows > $min) {
                    //     $(this).closest('tr').remove();
                    //     updateTableFieldJson();
                    //     return false;
                    // }
                });

                function addSubItem(item) {
                    item.parent().parent().parent().find('.cloneInputTo').append($tableWrapper.find('.cloneInput').clone().show().removeClass('cloneInput'));
                }

                function removeSubItem(item) {
                    var inputs = item.parent().parent().parent().find('.cloneInputTo input');
                    if (inputs.length >= 2) inputs.last().remove();
                }

                function addItem() {
                    $tableWrapper.find('tbody').append($tableWrapper.find('tbody .clonable').clone().show().removeClass('clonable'));
                }

                $tableWrapper.on('click', '.removeItem', function() {
                    var totalRows = $tableWrapper.find('tbody tr').not('.clonable').length;
                    if (totalRows > $min) {
                        $(this).closest('tr').remove();
                        updateTableFieldJson();
                        return false;
                    }
                });

                $tableWrapper.find('tbody').on('keyup', function() {
                    updateTableFieldJson();
                });


                function updateTableFieldJson() {
                    var $rows = $tableWrapper.find('tbody tr').not('.clonable');
                    var $fieldName = $tableWrapper.attr('data-field-name');
                    var $hiddenField = $($tableWrapper).find('input[name='+$fieldName+']');

                    var json = '[';
                    var otArr = [];
                    var tbl2 = $rows.each(function(i) {
                        //cloneInputTo
                        x = $(this).children().closest('td').find('input');
                        //var lnth = x.filter(function (index) { return this.value.length }).length;
                        var itArr = [];
                        var inArr = [];
                        x.each(function(index) {
                            var key = $(this).attr('data-name').replace('item.','');
                            console.log('x', key)
                            var value = this.value.replace(/(['"])/g, "\\$1"); // escapes single and double quotes

                            if ($(this).hasClass('val')) {
                                inArr.push('"' + value + '"');
                            } else {
                                itArr.push('"' + key + '":"' + value + '"');
                            }
                            if (x.length == index + 1 && key == "values") itArr.push('"' + key + '":' + '[' + inArr + ']' + '');

                        });
                        otArr.push('{' + itArr.join(',') + '}');
                    })
                    json += otArr.join(",") + ']';
                    console.log('json', json)
                    var totalRows = $rows.length;

                    $hiddenField.val( totalRows ? json : null );
                }

                // on page load, make sure the input has the old values
                updateTableFieldJson();
            }
        </script>
    @endpush
@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
