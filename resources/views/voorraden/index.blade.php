@extends('main')

@section('title', 'Verbruik grondstoffen')

@section('css')
	<!--  -->
@endsection

@section('content')

	    <div class = 'row'>
        <div class="col-md-8 col-md-offset-1">

            <table id="verbruikstable" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Productiedatum</th>
                    <th>Brouwsel</th>
                    <th>Grondstof</th>
                    <th class="text-right">Hoeveelheid (kg)</th>
                 </tr>
                 </thead>
                 <tbody id="voorraadbody">
                    @foreach($voorraadgrondstoffen as $voorraadgrondstof)
                        <tr>
                            <td data-order="strtotime({{ $voorraadgrondstof->datum }})">{{date('d-m-Y', strtotime($voorraadgrondstof->datum))}}</td>
                            <td>{{$voorraadgrondstof->liters}} x {{ $voorraadgrondstof->bier }}</td>
                            <td>{{ $voorraadgrondstof->grondstof }}</td>
                            <td class="text-right">{{ number_format($voorraadgrondstof->hoeveelheidkg, 1, ',', '.') }}</td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    
@endsection


@section('scripts')
    
    <script type="text/javascript">

        $(document).ready(function(){

            $('#verbruikstable').DataTable({
                "responsive": true,
                "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Alle"]],
                "pageLength": -1, //Default All
                "order": [[ 0, "desc" ]],
                "bPaginate": true,
                "searching": true,
                "processing": true,
                "language": {
                    "url": "/js/datatables_lang/datatables_lang_dut.json"
                },
                columnDefs: [ 
                    {
                        targets: [ 0 ],
                        orderData: [ 0, 1 ],
                        orderable: true
                    }, {
                        targets: [ 1 ],
                        orderData: [ 1, 0 ],
                        orderable: true
                    }, {
                        targets: [ 2 ],
                        orderable: true
                    }, {
                        targets: [ 3 ],
                        orderable: false
                    }
                ],
            });

        });
    </script>

@endsection

