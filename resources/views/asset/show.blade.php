<div class="modal-body wrapper">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Name')}}</h6>
                <p class="mb-20">{{ $asset->name }} </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Asset Number')}}</h6>
                <p class="mb-20">{{ $asset->asset_number }} </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Part')}}</h6>
                <p class="mb-20">{{ !empty($asset->parts)?$asset->parts->title:'-' }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Parent Asset')}}</h6>
                <p class="mb-20">{{ !empty($asset->parents)?$asset->parents->name:'-' }} </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('GIAI')}}</h6>
                <p class="mb-20">{{ $asset->giai }} </p>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Order Date')}}</h6>
                <p class="mb-20"> {{ dateFormat($asset->order_date) }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Purchase Date')}}</h6>
                <p class="mb-20"> {{ dateFormat($asset->purchase_date) }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Installation Date')}}</h6>
                <p class="mb-20"> {{ dateFormat($asset->installation_date) }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Warranty Expiration')}}</h6>
                <p class="mb-20"> {{ !empty($asset->warranty_expiration)?dateFormat($asset->warranty_expiration) :'-'}}</p>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Warranty Notes')}}</h6>
                <p class="mb-20">{{ !empty($asset->warranty_notes)?$asset->warranty_notes:"-" }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-12">
            <div class="detail-group">
                <h6>{{__('Description')}}</h6>
                <p class="mb-20">{{ !empty($asset->description)?$asset->description:"-" }}</p>
            </div>
        </div>
    </div>

</div>

