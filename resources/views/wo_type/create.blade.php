{{Form::open(array('url'=>'wo-type','method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('type',__('Type'),array('class'=>'form-label')) }} <span class="text-danger">*</span>
            {{Form::text('type',null,array('class'=>'form-control','placeholder'=>__('Enter type'),'required'=>'required'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}

