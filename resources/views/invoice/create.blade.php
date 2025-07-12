{{Form::open(array('url'=>'invoice','method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('invoice_id',__('Invoice Number'),array('class'=>'form-label'))}}
            <span class="text-danger">*</span>
            <div class="input-group">
                <span class="input-group-text ">
                  {{invoicePrefix()}}
                </span>
                {{Form::text('invoice_id',$invoiceNumber,array('class'=>'form-control','placeholder'=>__('Enter Invoice Number')))}}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('invoice_date',__('Invoice Date'),array('class'=>'form-label')) }} <span class="text-danger">*</span>
            {{Form::date('invoice_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('client', __('Client'),['class'=>'form-label']) }} <span class="text-danger">*</span>
            {!! Form::select('client', $clients, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('workorder',__('Work Order'),array('class'=>'form-label'))}} <span class="text-danger">*</span>
            <div class="workorder_div">
                <select class="form-control hidesearch workorder" id="workorder" name="workorder">
                    <option value="">{{__('Select Workorder')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('total',__('Total Amount'),array('class'=>'form-label'))}} <span class="text-danger">*</span>
            {{Form::number('total',null,array('class'=>'form-control','placeholder'=>__('Enter total amount'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('discount',__('Discount'),array('class'=>'form-label'))}}
            {{Form::number('discount',null,array('class'=>'form-control','placeholder'=>__('Enter discount')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('due_date',__('Due Date'),array('class'=>'form-label')) }} <span class="text-danger">*</span>
            {{Form::date('due_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('status', __('Status'),['class'=>'form-label']) }} <span class="text-danger">*</span>
            {!! Form::select('status', $status, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('notes',__('Notes'),array('class'=>'form-label')) }}
            {{Form::textarea('notes',null,array('class'=>'form-control','rows'=>2))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}
<script>
    // Document ready function
    $(document).ready(function() {
        // Initialize select2
        $('.hidesearch').select2({
            minimumResultsForSearch: -1
        });

        // Event handler for client change
        $('#client').on('change', function () {
            var client = $(this).val();
            var url = '{{ route("client.workorder") }}';
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    client: client,
                },
                type: 'GET',
                success: function (data) {
                    $('.workorder').empty().append('<option value="">{{__('Select Workorder')}}</option>');
                    $.each(data, function(key, value) {
                        $('.workorder').append('<option value="' + key + '">' + value + '</option>');
                    });

                },
            });
        });

        // Event delegation for workorder change
        $(document).on('change', '.workorder', function () {
            var workorder = $(this).val();
            var url = '{{ route("workorder.details") }}';
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    workorder: workorder,
                },
                type: 'GET',
                success: function (data) {
                    $('#total').val(data);
                },
            });
        });
    });
</script>
