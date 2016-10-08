@extends('layouts.app')

@section('content')
<!--physical examination page-->
<script type="text/javascript">
  function select_physical(input){
    if(input.checked){
      var table = document.getElementById('tbl_physical_examination');
      var num = document.getElementById("tbl_physical_examination").rows.length;
      var row1 = table.insertRow(num);
      var cell1 = row1.insertCell(0);
      var row2 = table.insertRow(num+1);
      var cell2 = row2.insertCell(0);
      var cell3 = row2.insertCell(1);
      var cell4 = row2.insertCell(2);
      var cell5 = row2.insertCell(3);
      var cell6 = row2.insertCell(4);
      @if(count($physical)>0)
        @foreach($physical as $p)
        if(input.value == "{{ $p->id }}"){
          row1.id = "{{ $p->id }}_1";
          row2.id = "{{ $p->id }}_2";
          cell1.colSpan = "5";
          cell1.classList.add("warning");
          cell1.innerHTML = '<h4>{{ $p->position }}</h4>';
          cell1.innerHTML += '<input type="hidden" name="physical_examination_id[]" value="{{ $p->id }}">';

          cell2.innerHTML += '<strong>{{ $p->side }}</strong>';
          cell2.classList.add("col-sm-1");
          cell3.innerHTML = '<strong>{{ $p->direction1 }}</strong> <strong>{{ $p->direction1_max}}º</strong>';
          cell3.classList.add("col-sm-2");
          cell4.innerHTML = '<input type="text" class="form-control" name="direction1_value[]">';
          cell4.classList.add("col-sm-1");
          cell5.innerHTML = '<strong>{{ $p->direction2 }}</strong> <strong>{{ $p->direction2_max}}º</strong>';
          cell5.classList.add("col-sm-2");
          cell6.innerHTML = '<input type="text" class="form-control" name="direction2_value[]">';
          cell6.classList.add("col-sm-1");

        }
        @endforeach
      @endif
    }else{
      @if(count($physical)>0)
        @foreach($physical as $p)
        if(input.value == "{{ $p->id }}"){
          document.getElementById("{{ $p->id }}_1").remove();
          document.getElementById("{{ $p->id }}_2").remove();
        }
        @endforeach
      @endif
    }
  }

  function PE_databind(){
    var table = document.getElementById('tbl_physical_examination');
    var textarea = document.getElementById('physical_examinations');
    var text = "";
    var num = document.getElementById("tbl_physical_examination").rows.length;

    for (var i = 0, row; row = table.rows[i]; i++) {
       //iterate through rows
       //rows would be accessed using the "row" variable assigned in the for loop
       for (var j = 0, col; col = row.cells[j]; j++) {
         //iterate through columns
         //columns would be accessed using the "col" variable assigned in the for loop
         if(i%2 == 0){
           if(i!=0){
             text += "\n";
           }
           text += col.children[0].innerHTML+ "  ";
         }else{
           if(j==2||j==4){
             text += col.children[0].value + "º   ";
           }else{
             text += col.children[0].innerHTML + " : ";
           }
         }

       }
    }
    textarea.innerHTML = text;
  }
</script>
<div class="container">
    <div class="row">
      <div class="well well-sm col-sm-12">
        <div class="col-sm-3">
          <a href="{{ url('/patient/'.$record->patient_id)}}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
      </div>
        <div class="col-md-10 col-md-offset-1">
          <form class="form" action="{{ url('/medical_record/'.$record->id)}}" method="post" role="form">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put" />
            <div class="form-group">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Main</a></li>
                <li role="presentation"><a href="#physical" aria-controls="physical" role="tab" data-toggle="tab">Physical</a></li>
              </ul>
              <div class="tab-content">
                <!--main page-->
                <div role="tabpanel" class="tab-pane fade in active" id="main">
                  <table class="table table-hover table-bordered table-condense">
                    <tr class="warning">
                      <th>
                        {{ $patient->surname}} {{$patient->last_name}}
                        <input type="hidden" name="patient_id" value="{{ $record->patient_id }}">
                      </th>
                      <th>
                        DOB : {{ date('d-m-Y', strtotime($patient->DOB))}}
                      </th>
                      <th>
                        No.
                      </th>
                      <td>
                        <input class="form-control" type="number" min="0" step="1" name="treatment_number" value="{{ $record->treatment_number }}" required>
                      </td>
                      <td>Date</td>
                      <td>
                        <div class="input-append date" id="dp3" data-date="{{ date('d-m-Y')}}" data-date-format="dd-mm-yyyy">
                          <input class="span2 form-control" name="date" size="16" type="text" value="{{ date('d-m-Y', strtotime($record->date))}}" required>
                          <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th class="info" colspan="6">Symptoms</th>
                    </tr>
                    <tr>
                      <td class="warning">Main Complaint / S</td>
                      <td colspan="5"><input class="form-control" type="text" name="main_complaint" value="{{ $record->main_complaint}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">Current Condition and Accompanied Symptoms</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="symptoms">{{ $record->symptoms}}</textarea></td>
                    </tr>
                    <tr>
                      <td class="warning">General Question</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="general_question">{{ $record->general_question }}</textarea></td>
                    </tr>
                    <tr>
                      <td class="warning">Current Physical Examinations
                        <button type="button" class="btn btn-default btn-block" onclick="PE_databind();">Add</button>
                      </td>
                      <td colspan="5"><textarea class="form-control" rows="7" id="physical_examinations" name="physical_examinations">{{ $record->physical_examinations}}</textarea></td>
                    </tr>
                    <tr class="info">
                      <th colspan="6">Tongue:</th>
                    </tr>
                    <tr>
                      <td class="col-sm-1 warning">Tongue Texture</td>
                      <td colspan="2" class="col-sm-3">
                        <label class="radio-inline">
                          <input type="radio" name="tongue_status" value="Moistening" @if($record->tongue_status == "Moistening") checked @endif>Moistening
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="tongue_status" value="Dryness" @if($record->tongue_status == "Dryness") checked @endif>Dryness
                        </label>
                      </td>
                      <td class="col-sm-1 warning">Body Colour</td>
                      <td colspan="2" class="col-sm-3"><input class="form-control" type="text" name="body_colour" value="{{ $record->body_colour}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">Shape</td>
                      <td colspan="2"><input class="form-control" type="text" name="shape" value="{{ $record->shape}}"></td>
                      <td class="warning">Movement</td>
                      <td colspan="2"><input class="form-control" type="text" name="movement" value="{{$record->movement}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">Proper of Coating</td>
                      <td colspan="2"><input class="form-control" type="text" name="proper_of_coating" value="{{ $record->proper_of_coating}}"></td>
                      <td class="warning">Coating Colour</td>
                      <td colspan="2"><input class="form-control" type="text" name="coating_colour" value="{{ $record->coating_colour}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">Pulses (Overall Speed)</td>
                      <td colspan="5">
                        <label class="radio-inline">
                          <input type="radio" name="pulses" value="Slow" @if($record->pulses == "Slow") checked @endif>Slow
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="pulses" value="Moderate" @if($record->pulses == "Moderate") checked @endif>Moderate
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="pulses" value="Fast" @if($record->pulses == "Fast") checked @endif>Fast
                        </label>
                      </td>
                    </tr>
                    <tr class="info">
                      <td colspan="3" align="center">Right</td>
                      <td colspan="3" align="center">Left</td>
                    </tr>
                    <tr>
                      <td class="warning">Lung (qi)</td>
                      <td colspan="2"><input class="form-control" type="text" name="lung_qi" value="{{ $record->lung_qi}}"></td>
                      <td class="warning">Heart (blood)</td>
                      <td colspan="2"><input class="form-control" type="text" name="heart_blood" value="{{ $record->heart_blood}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">Spleen</td>
                      <td colspan="2"><input class="form-control" type="text" name="spleen" value="{{ $record->spleen}}"></td>
                      <td class="warning">Liver</td>
                      <td colspan="2"><input class="form-control" type="text" name="liver" value="{{ $record->liver}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">Kidney (yang / qi)</td>
                      <td colspan="2"><input class="form-control" type="text" name="kidney_yang" value="{{ $record->kidney_yang}}"></td>
                      <td class="warning">Kidney (yin)</td>
                      <td colspan="2"><input class="form-control" type="text" name="kidney_yin" value="{{ $record->kidney_yin}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">TCM Disease</td>
                      <td colspan="5"><input class="form-control" type="text" name="TCM_disease" value="{{ $record->TCM_disease}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">TCM Type / Pattern</td>
                      <td colspan="5"><input class="form-control" type="text" name="TCM_type" value="{{ $record->TCM_type}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">Treatment Principle</td>
                      <td colspan="5"><input class="form-control" type="text" name="treatment_principle" value="{{ $record->treatment_principle}}"></td>
                    </tr>
                    <tr>
                      <td class="warning">Acu-points & Techniques/s & Methods/s</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="Acu_points">{{ $record->Acu_points}}</textarea></td>
                    </tr>
                    <tr>
                      <td class="warning">Explanation Of Treatment</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="treatment_explanation">{{ $record->treatment_explanation}}</textarea></td>
                    </tr>
                    <tr>
                      <td class="warning">Cautions, Contraindications and Red Flag</td>
                      <td colspan="5"><input class="form-control" type="text" name="cautions" value="{{ $record->cautions }}"></td>
                    </tr>
                    <tr>
                      <td class="warning">Post Treatment Advice</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="treatment_adjustments">{{ $record->treatment_adjustments}}</textarea></td>
                    </tr>
                  </table>
                  <input type="submit" class="btn btn-success" value="Submit">
                  <button type="button" class="btn btn-danger" name="button" onclick="window.history.back();">Cancel</button>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="physical">
                  <div class="col-sm-12">
                    <div class="col-sm-4">
                      @if(count($physical)>0)
                      <table class="table table-hover table-bordered table-condense">
                        @foreach($physical as $p)
                          <tr>
                            <td class="col-sm-1"><input type="checkbox" onchange="select_physical(this);" value="{{ $p->id }}" @foreach($PE_records as $PE) @if($PE->physical_examination_id == $p->id) checked @endif @endforeach></td>
                            <td class="col-sm-3">{{$p->position}}</td>
                          </tr>
                        @endforeach
                      </table>
                      @else
                      <h3>Not set yet !</h3>
                      @endif
                    </div>
                    <div class="col-sm-8">
                      <table class="table table-hover table-bordered table-condense" id="tbl_physical_examination">
                        @if(count($PE_records)>0)
                          @foreach( $PE_records as $PE)
                          <tr id="{{$PE->physical_examination_id}}_1">
                            <td colSpan="5" class="warning"><h4>{{ $PE->position }}</h4><input type="hidden" name="physical_examination_id[]" value="{{ $PE->physical_examination_id }}"></td>
                          </tr>
                          <tr id="{{$PE->physical_examination_id}}_2">
                            <td class="col-sm-1"><strong>{{ $PE->side }}</strong></td>
                            <td class="col-sm-2">
                              <strong>{{ $PE->direction1 }}</strong> <strong>{{ $PE->direction1_max}}º</strong>
                            </td>
                            <td class="col-sm-1">
                              <input type="text" class="form-control" name="direction1_value[]" value="{{ $PE->direction1_value}}">
                            </td>
                            <td class="col-sm-2">
                              <strong>{{ $PE->direction2 }}</strong> <strong>{{ $PE->direction2_max}}º</strong>
                            </td>
                            <td class="col-sm-1">
                              <input type="text" class="form-control" name="direction2_value[]" value="{{ $PE->direction2_value}}">
                            </td>
                          </tr>
                          @endforeach
                        @endif
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection
