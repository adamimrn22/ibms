@extends('layouts.app')

@section('csslink')
    <style>
        .carousel-inner {
            max-height: 500px;
            /* Set your desired fixed height for the carousel */
            display: flex;
        }

        .carousel-item {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-item img {
            max-width: 100%;
            object-fit: cover;
            object-position: center;
            /* Use 'cover' if you want to cover the slide or 'contain' to fit inside preserving aspect ratio */
        }
    </style>
@endsection

@section('layout')
    <x-app-content>
        {{ Breadcrumbs::render('office.edit', $office) }}

        <div class="row mt-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Office Details </h3>
                </div>
                <div class="card-body">

                    <h3>{{ $office->name }}</h3>

                    <table class="table table-bordered text-nowrap text-center mt-1">
                        <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col" width="80%">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-start">Sofa</th>
                                <td>
                                    <span>{{ $office->attribute->Sofa }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-start">Drawer</th>
                                <td>
                                    <span>{{ $office->attribute->Drawer }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-start">Table</th>
                                <td>
                                    <span>{{ $office->attribute->Table }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-start">Chair</th>
                                <td>{{ $office->attribute->Chair }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-start">Foldable Chair</th>
                                <td>{{ $office->attribute->Foldable_Chair }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-start">Whiteboard</th>
                                <td>{{ $office->attribute->Whiteboard }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-start">Duster</th>
                                <td>{{ $office->attribute->Duster }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-start">Status</th>
                                <td>{{ $office->Status->name }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </x-app-content>
@endsection


@section('script')
    @if ($errors->any())
        <script>
            toastr.error('Validation Error', 'Error');
        </script>
    @endif
@endsection
