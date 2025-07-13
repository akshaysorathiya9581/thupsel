{{Form::model($category, array('route' => array('category.update', $category->id), 'method' => 'PUT','enctype' => "multipart/form-data")) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('name',__('Name'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'), 'required'))}}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('type', __('Type'), ['class' => 'form-label']) }}
            <div class="d-flex gap-3">
                <div class="form-check">
                    {{ Form::radio('type', 'parts', false, ['id' => 'type_parts', 'class' => 'form-check-input', 'required']) }}
                    {{ Form::label('type_parts', 'Parts', ['class' => 'form-check-label']) }}
                </div>
                <div class="form-check">
                    {{ Form::radio('type', 'service', false, ['id' => 'type_service', 'class' => 'form-check-input']) }}
                    {{ Form::label('type_service', 'Service', ['class' => 'form-check-label']) }}
                </div>
                <div class="form-check">
                    {{ Form::radio('type', 'inventory', false, ['id' => 'type_inventory', 'class' => 'form-check-input']) }}
                    {{ Form::label('type_inventory', 'Inventory', ['class' => 'form-check-label']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary btn-rounded'))}}
</div>
{{ Form::close() }}