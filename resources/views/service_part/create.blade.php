{{ Form::open(['url' => 'services-parts', 'method' => 'post']) }}
<div class="modal-body wrapper">
    <div class="row">
        <div class="form-group col-md-12">
            <div class="form-check custom-chek form-check-inline">
                <input class="form-check-input type" type="radio" value="part" id="part" name="type" checked>
                <label class="form-check-label" for="part">{{ __('Inventory') }}</label>
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('cat_id', __('Select Categories'), ['class' => 'form-label']) }}
            {{ Form::select('cat_id', $category, null, ['class' => 'form-control', 'placeholder' => 'Choose categories...', 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('title', __('Title'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter title'), 'required']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('sku', __('No of Qty'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
            {{ Form::text('sku', null, ['class' => 'form-control', 'placeholder' => __('Enter no of qty'), 'required']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('price', __('Price'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
            {{ Form::text('price', null, ['class' => 'form-control', 'placeholder' => __('Enter price'), 'required']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('unit', __('Unit'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
            {{ Form::text('unit', null, ['class' => 'form-control', 'placeholder' => __('Enter unit')]) }}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
            {{ Form::text('description', null, ['class' => 'form-control', 'placeholder' => __('Enter description')]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-primary ml-10']) }}
</div>
{{ Form::close() }}
