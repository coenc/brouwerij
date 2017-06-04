@extends('main')

@section('title', 'Recepten')

@section('css')
    <style>
    /*comment*/
    </style>
@endsection

@section('content')

    <div class = 'row'>
        <div class="row col-md-3 col-xs-7 col-md-offset-1">
            <div class="form-group" >
                <select id="mySelect" name="mySelect" class="form-control">
                    <option selected="selected" disabled>Selecteer product</option>
                        @foreach($bierdropdown as $bier)
                            <option value="{{$bier->id}}">{{$bier->code}} - {{$bier->omschrijving}}</option>
                        @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class = 'row'>
        <div class="col-md-5 col-md-offset-1 col-xs-12">
            <table class="table table-striped table-hover" id="table_ingredienten">
                <thead>
                <tr> 
                    <th>Kg</th>
                    <th>Grondstof</th>
                    <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>Nieuw ingrdiënt</button></th>
                </tr>
                </thead>
                <tbody id="recept_body">
                    {{-- ...Table body here via jQuery... --}}
                </tbody>
            </table>
        </div>
    </div> <!-- div class row-->


    <!-- modal form for editing and adding -->
    <div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div id="ajaxloader">
                    <img src= '/images/ajax-loader.gif'>
                    <div>Ingrediënt opslaan</div>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bewerk ingrediënt</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                    <div class="row">    
                        <div class="col col-md-12">
                        {!! Form::model($recepten, ['data-parsley-validate' => '', 'id'=>'uploadForm', 'files' => false])  !!}

                            <div class="form-group">
                                <input type="hidden" id="recept_id" name="recept_id"/>
                                <input type="hidden" id="biersoort_id" name="biersoort_id" />
                            </div>

                            <div class="form-group error col-md-4">
                                {{ Form::label('hoeveelheid', 'Hoeveelheid:', 'class="control-label"') }}
                                {{ Form::text('hoeveelheid', null, ["class" => 'form-control', 'required' => '' ]) }}
                            </div>
                            <div class="form-group error col-md-8">
                                    {{ Form::label('grondstof_id', 'Grondstof:', 'class="control-label"') }} 
                                    {{ Form::select('grondstof_id', $grondstofdropdown, null, ['class' => 'form-control', 'required' => '', 'id' => 'grondstof_id']) }}
                            </div>                            
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- modal body -->
                
                <div class="modal-footer">
                    <div class="col col-md-12">
                        <button type="button" class="btn btn-primary" id="btn-cancel">Annuleren</button>
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Opslaan</button>
                    </div>
                </div><!-- modal footer -->
            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal -->

@endsection

@section('scripts')

<script type="text/javascript">
    
    var url = '/receptregel/';

    // Delete button
    $('#table_ingredienten').on('click','.btn-delete', function(){

        var receptregel_id = $(this).val();
        
        swal({
          title: 'Ingrediënt verwijderen?',
          text: "Weet u het zeker? Deze aktie kan niet ongedaan worden gemaakt!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Verwijder'
        }).then(function () {
            //AJAX call to delete receptregel
            $.ajax({
                type: "DELETE",
                url: url + receptregel_id,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (data) {
                    //remove row from table
                    $("#recept" + receptregel_id).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        })
        .catch(swal.noop)
    });

    // Bewerk button
    $(document).on('click','.open-modal', function(){
        var receptregel_id = $(this).val();
        $.get(url + receptregel_id, function (data) {
            //success data
            console.log(data);
            $('#myModalLabel').text("Bewerk ingrediënt");
            $('#biersoort_id').val(data.biersoort_id);
            $('#recept_id').val(data.id);
            $('#grondstof_id').val(data.grondstof_id);
            $('#hoeveelheid').val(data.hoeveelheid);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
        })
    });


    $('#mySelect').change(function(){ 
        
        // Fill table with recept rows for the selected biersoort

        var biersoort_id = $(this).val();
        var biersoort_name = $("#mySelect :selected").text();
        var table_body;

        $.ajax({
            type: "GET",
            data: {biersoort_id: biersoort_id},
            url: '/recept',
            dataType: 'json',
            success: function(json_data) {
                //throw json data into bootstrap table body with id 
                table_body = "";
                // table_body += "<tbody id='recept_body'>";
                $.each(json_data, function(index){
                    //alert(json_data[index].id + json_data[index].hoeveelheid + json_data[index].naam);
                    table_body += "     <tr id='recept" + json_data[index].id + "'>";
                    table_body += "         <td>" + json_data[index].hoeveelheid + "</td>";
                    table_body += "         <td>" + json_data[index].naam + "</td>";
                    table_body += "         <td  align='right'>"
                    table_body += "             <div class='input-group'>";
                    table_body += "                 <div class='input-group-btn'>";
                    table_body += "                     <button class='btn btn-warning btn-xs btn-detail open-modal but-spacing' value='" + json_data[index].id + "'><span class='glyphicon glyphicon-edit'></span>Bewerk</button>"; 
                    table_body += "                     <button class='btn btn-danger btn-xs btn-delete delete-receptregel but-spacing' value='" + json_data[index].id + "'><span class='glyphicon glyphicon-remove'></span>Verwijder</button>";
                    table_body += "                 </div>";                    
                    table_body += "             </div>";
                    table_body += "         </td>"
                    table_body += "     </tr>";
                });
                
                $('#recept_body').html(table_body);
                
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });

    });


    $(document).ready(function(){

        var urlingredient = "/receptregel";

        //Cancel button
        $('#btn-cancel').click(function(){
            $('#myModal').modal('hide');
        });

        //Add button
        $('#btn-add').click(function(){
            // alert($("#mySelect :selected").val());
            if($.isNumeric($("#mySelect :selected").val())){
                // A beer was selected from select
                $('#myModalLabel').text("Nieuw ingrediënt");
                $('#btn-save').val('add');
                $('#biersoort_id').val($("#mySelect :selected").val());
                $('#grondstof_id').val('');
                $('#hoeveelheid').val('');
                $('#myModal').modal('show');
            }
        });

        $('#btn-save').click(function(e){

            $('#ajaxloader').show();

            e.preventDefault();
            
            var formData = {
                biersoort_id: $('#biersoort_id').val(),
                grondstof_id: $('#grondstof_id').val(),
                hoeveelheid: $('#hoeveelheid').val(),
            };

            //determine the http action [add=POST], [update=PUT]
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var recept_id = $('#recept_id').val();
            var my_url = url;

            if (state == "update"){
                type = "PUT"; //for updating existing resource
                my_url = my_url + recept_id;
            }

            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (json_data) {
                    //update row from table
                    var updated_row = '';
                    updated_row += "     <tr id='recept" + json_data.id + "'>";
                    updated_row += "         <td>" + json_data.hoeveelheid + "</td>";
                    updated_row += "         <td>" + $('#grondstof_id').find('option:selected').text() + "</td>";
                    updated_row += "         <td  align='right'>"
                    updated_row += "             <div class='input-group'>";
                    updated_row += "                 <div class='input-group-btn'>";
                    updated_row += "                     <button class='btn btn-warning btn-xs btn-detail open-modal but-spacing' value='" + json_data.id + "'><span class='glyphicon glyphicon-edit'></span>Bewerk</button>"; 
                    updated_row += "                     <button class='btn btn-danger btn-xs btn-delete delete-receptregel but-spacing' value='" + json_data.id + "'><span class='glyphicon glyphicon-remove'></span>Verwijder</button>";
                    updated_row += "                 </div>";                    
                    updated_row += "             </div>";
                    updated_row += "         </td>"
                    updated_row += "     </tr>";

                    if (state == "add"){ 
                        //user added a new record
                        console.log(updated_row);
                        $('#recept_body').prepend(updated_row);
                    }else{ 
                        //user updated an existing record
                        // $("#recept" + recept_id).replaceWith(updated_row); //This works only once ... (?)
                        document.getElementById('recept' + json_data.id).innerHTML = updated_row;
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            $('#ajaxloader').hide();
            $('#myModal').modal('hide');
        });

    });



</script>



@endsection