@forelse ($serviceParts as $servicePart)
    <tr>
        <td>{{ $servicePart->category->name }} </td>
        <td>{{ $servicePart->title }} </td>
        <td>{{ $servicePart->sku }} </td>
        <td>{{ priceFormat($servicePart->price) }} </td>
        <td>{{ $servicePart->unit }} </td>
        <td>{{ ucfirst($servicePart->type) }} </td>
        <td>
            @if($servicePart->image)
                <img class="img-fluid rounded-50" src="{{ asset('storage/upload/service_part/' . $servicePart->image) }}" alt="image">
            @else
                -
            @endif
        </td>
        <td>{{ !empty($servicePart->description)?$servicePart->description:"-" }} </td>
        <td>
            <div class="cart-action">
                {!! Form::open(['method' => 'DELETE', 'route' => ['services-parts.destroy', $servicePart->id]]) !!}
                @can('show service & part')
                    <a class="text-warning customModal" data-bs-toggle="tooltip" data-size="lg"
                    data-bs-original-title="{{__('Details')}}" href="#"
                    data-url="{{ route('services-parts.show',$servicePart->id) }}"
                    data-title="{{__('Inventory Detail')}}"> <i data-feather="eye"></i></a>
                @endcan
                @can('edit service & part')
                    <a class="text-success customModal" data-bs-toggle="tooltip" data-size="lg"
                    data-bs-original-title="{{__('Edit')}}" href="#"
                    data-url="{{ route('services-parts.edit',$servicePart->id) }}"
                    data-title="{{__('Edit Inventory Items')}}"> <i data-feather="edit"></i></a>
                @endcan
                @can('delete service & part')
                    <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                    data-bs-original-title="{{__('Delete')}}" href="#"> <i
                            data-feather="trash-2"></i></a>
                @endcan
                {!! Form::close() !!}
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center text-danger">
            {{ __('No data found.') }}
        </td>
    </tr>
@endforelse