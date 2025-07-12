<div class="modal-body wrapper">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="detail-group">
                <h6>{{__('Request Detail')}}</h6>
                <p class="mb-20">{{ $wORequest->request_detail }} </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Client')}}</h6>
                <p class="mb-20">{{ !empty($wORequest->clients)?$wORequest->clients->name:'-' }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Asset')}}</h6>
                <p class="mb-20">{{ !empty($wORequest->assets)?$wORequest->assets->name:'-' }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Due Date')}}</h6>
                <p class="mb-20">{{ dateFormat($wORequest->due_date) }}  </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Priority')}}</h6>
                <p class="mb-20">
                    @if($wORequest->priority=='low')
                        <span
                            class="badge badge-primary">{{\App\Models\WORequest::$priority[$wORequest->priority] }}</span>
                    @elseif($wORequest->priority=='medium')
                        <span
                            class="badge badge-info">{{\App\Models\WORequest::$priority[$wORequest->priority] }}</span>
                    @elseif($wORequest->priority=='high')
                        <span
                            class="badge badge-warning">{{\App\Models\WORequest::$priority[$wORequest->priority] }}</span>
                    @elseif($wORequest->priority=='critical')
                        <span
                            class="badge badge-danger">{{\App\Models\WORequest::$priority[$wORequest->priority] }}</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Status')}}</h6>
                <p class="mb-20">
                    @if($wORequest->status=='pending')
                        <span
                            class="badge badge-warning">{{\App\Models\WORequest::$status[$wORequest->status] }}</span>
                    @elseif($wORequest->status=='in_progress')
                        <span
                            class="badge badge-primary">{{\App\Models\WORequest::$status[$wORequest->status] }}</span>
                    @elseif($wORequest->status=='completed')
                        <span
                            class="badge badge-success">{{\App\Models\WORequest::$status[$wORequest->status] }}</span>
                    @elseif($wORequest->status=='cancel')
                        <span
                            class="badge badge-danger">{{\App\Models\WORequest::$status[$wORequest->status] }}</span>
                    @endif
                </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Assign')}}</h6>
                <p class="mb-20"> {{!empty($wORequest->assigned)?$wORequest->assigned->name:'-' }}</p>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="detail-group">
                <h6>{{__('Notes')}}</h6>
                <p class="mb-20">{{ !empty($wORequest->notes)?$wORequest->notes:"-" }}</p>
            </div>
        </div>
        <hr>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Preferred Date')}}</h6>
                <p class="mb-20"> {{ dateFormat($wORequest->preferred_date) }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Preferred Time')}}</h6>
                <p class="mb-20"> {{$wORequest->preferred_time}}</p>
            </div>
        </div>

        <div class="col-md-12 col-lg-12">
            <div class="detail-group">
                <h6>{{__('Preference Note')}}</h6>
                <p class="mb-20">{{ !empty($wORequest->preferred_note)?$wORequest->preferred_note:"-" }}</p>
            </div>
        </div>
    </div>

</div>

