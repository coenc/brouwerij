@extends('main')
@section('title', 'Correspondentie')



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

	<div class="col-md-12 col-md-offset-1">
		<div class="well">
			<div id="printableArea">
				
				{{ $leverancier->naam or ''}}<br>
				{{ $leverancier->factuuradres  or ''}}<br>
				{{ $leverancier->factuurpostcode  or ''}}<br>
				{{ $leverancier->factuurplaats  or ''}}<br>
				<br>
				<br>
				Amsterdam, {{date("d M Y")}}<br>
				<br>
				Geachte heer, mevrouw {{ $leverancier->factuurnaam }},<br>
				<br>
				<br>
				<br>
				<br>

				<br>
				<br>
				<br>
				<br>
				Met vriendelijke groeten,<br>
				<br>
				<br>
					{{$group->groupname or ''}}<br>
					{{$group->adres or ''}} {{$group->postcode or ''}}<br>
					{{$group->woonplaats or ''}} 				
			</div>
		</div>
	</div>
	<div class="col-md-12 ">
		<div class="col col-md-12 col-md-offset-1 align-left" id="printbutton" style="margin-top:20px">
			<input type="button" onclick="printDiv('printableArea')" value="Afdrukken" />
		</div>

	</div>




@endsection

@section('scripts')

	<script type="text/javascript">
		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
 			document.body.innerHTML = originalContents;
	 	};
     </script>
}

@endsection