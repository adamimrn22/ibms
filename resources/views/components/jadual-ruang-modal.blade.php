<link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">

<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Jadual Ruang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="/jadualRuang" target="_blank">
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <x-form.label :for="'dateFromRange'" :title="'From'" />
                                    <input type="text" id="dateFromRange" name="dateFromRange"
                                        class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                                </td>
                                <td>
                                    <x-form.label :for="'dateToRange'" :title="'To'" />
                                    <input type="text" id="dateToRange" name="dateToRange"
                                        class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                                </td>
                            </tr>
                            <tr>
                                @csrf
                                <td colspan="2">
                                    <select style="overflow:hidden" id="roomTypeFilter" name="room_type"
                                        class="select2 form-select form-select ">
                                        @foreach ($rooms as $roomSelect)
                                            <option value="{{ $roomSelect->id }}|{{ $roomSelect->name }}">
                                                {{ $roomSelect->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary waves-effect waves-float waves-light" id="filterButton">Lihat
                        Jadual Ruang</button>
                </div>

            </form>
        </div>
    </div>
</div>
