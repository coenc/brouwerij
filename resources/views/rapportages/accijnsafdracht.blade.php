@extends('main')
@section('title', 'Accijnsafdracht')



@section('css')
<style>
	@media print {
	  	.page-header * {
		    visibility: hidden;
		}
		navbar * {
			visibility: hidden;
		}
		#printbutton{
			visibility: hidden;	
		}
		#section-to-print, #section-to-print * {
			visibility: visible;
		}
		#section-to-print {
			position: absolute;
			left: 0;
			top: 0;
		}
	}
</style>
@endsection


@section('content')

	<div class="col-md-6">
		
			<div id="printableArea">

			<table class="table table-striped table-hover" id="grondstofcattable">

				 <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Product</th>
                        <th>Liters</th>
                        <th>Tarief per HL</th>
                        <th class="text-right">Afdracht (€)</th>
                    </tr>
                </thead>

                <tbody id="grondstofcatbody">
					@foreach($data as $item)
	                    <tr>
	                    	<td>{{date('d-m-Y', strtotime($item->datum)) }}</td>
	                    	<td>{{$item->omschrijving}}</td>
	                    	<td>{{$item->liters}}</td>
	                    	<td>{{$item->tariefperhl}}</td>
	                    	<td class="text-right">€ {{$item->afdracht}}</td>
	                    </tr>
	                @endforeach

					@foreach($total as $tot)
                        <tr>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                            <td class="text-right"><strong>€ {{$tot->total}}</strong></td>
                        </tr>
                    @endforeach

	            </tbody>
            </table>



			</div>
		
	</div>
	<div class="col-md-7">
		<div class="col col-md-12 align-left" id="printbutton" style="margin-top:20px">
			<input type="button" onclick="printDiv('printableArea')" value="Afdrukken" />
		</div>

	</div>

@endsection

@section('scripts')

	<script type="text/javascript">
		function printDiv(divName) {
			$('#printtext').val($('#mytextarea').value); 
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
 			document.body.innerHTML = originalContents;
	 	};
     </script>

@endsection