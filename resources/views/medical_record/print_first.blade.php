@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="well well- sm col-sm-12 hidden-print">
        <div class="col-sm-3">
          <a href="{{ url('/patient/'.$record->patient_id)}}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
        <div class="col-sm-3">
          <button type="button" onclick="print();" class="btn btn-primary btn-block" name="button">Print</button>
        </div>
      </div>
        <div class="col-md-10 col-md-offset-1">
          <table border="1">
            <tr class="warning">
              <th width="125px">
                <p>
                  {{ $record->surname}} {{$record->last_name}}
                </p>
              </th>
              <th>
                <p>
                  DOB : {{ date('d-m-Y', strtotime($record->DOB))}}
                </p>
              </th>
              <th>
                <p>
                  No.
                </p>
              </th>
              <td width="125px">
                <p>
                  {{ $record->treatment_number }}
                </p>
              </td>
              <td>
                <p>
                  Date
                </p>
              </td>
              <td>
                <p>
                  {{ date('d-m-Y', strtotime($record->date))}}
                </p>
              </td>
            </tr>
            <tr>
              <th class="warning">
                <p>
                  Injury Date
                </p>
              </th>
              <td colspan="5">
                <p>
                  {{ date('d-m-Y', strtotime($record->injury_date))}}
                </p>
              </td>
            </tr>
            <tr>
              <th class="info" colspan="6">
                <p>
                  Symptoms
                </p>
              </th>
            </tr>
            <tr>
              <td class="warning">
                <p>
                  Main Complaint / S
                </p>
              </td>
              <td colspan="5">
                <p>
                  {{ $record->main_complaint}}
                </p>
              </td>
            </tr>
            <tr>
              <td class="warning">
                <p>
                  Current Condition and Accompanied Symptoms
                </p>
              </td>
              <td colspan="5">
                <p>
                  {{ $record->symptoms}}
                </p>
              </td>
            </tr>
            <tr>
              <td class="warning">
                <p>
                  General Question
                </p>
              </td>
              <td colspan="5">
                <p>
                  {{ $record->general_question }}
                </p>
              </td>
            </tr>
            <tr>
              <td class="warning">
                <p>
                  Current Physical Examinations
                </p>
              </td>
              <td colspan="5">
                <p>
                  {{ $record->physical_examinations}}
                </p>
              </td>
            </tr>
            <tr class="info">
              <th colspan="6">
                <p>
                  Tongue:
                </p>
              </th>
            </tr>
            <tr>
              <td class="col-sm-1 warning">
                <p>
                  Tongue Texture
                </p>
              </td>
              <td colspan="2" class="col-sm-3">
                <p>
                  {{ $record->tongue_status }}
                </p>
              </td>
              <td class="col-sm-1 warning">
                <p>
                  Body Colour
                </p>
              </td>
              <td colspan="2" class="col-sm-3">
                <p>
                  {{ $record->body_colour}}
                </p>
              </td>
            </tr>
            <tr>
              <td class="warning"><p>Shape</p></td>
              <td colspan="2"><p>{{ $record->shape}}</p></td>
              <td class="warning"><p>Movement</p></td>
              <td colspan="2"><p>{{$record->movement}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Proper of Coating</p></td>
              <td colspan="2"><p>{{ $record->proper_of_coating}}</p></td>
              <td class="warning"><p>Coating Colour</p></td>
              <td colspan="2"><p>{{ $record->coating_colour}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Pulses (Overall Speed)</p></td>
              <td colspan="5">
                <p>
                  {{ $record->pulses }}
                </p>
              </td>
            </tr>
            <tr class="warning">
              <td colspan="3" align="center"><p>Right</p></td>
              <td colspan="3" align="center"><p>Left</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Lung (qi)</p></td>
              <td colspan="2"><p>{{ $record->lung_qi}}</p></td>
              <td class="warning"><p>Heart (blood)</p></td>
              <td colspan="2"><p>{{ $record->heart_blood}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Spleen</p></td>
              <td colspan="2"><p>{{ $record->spleen}}</p></td>
              <td class="warning"><p>Liver</p></td>
              <td colspan="2"><p>{{ $record->liver}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Kidney (yang / qi)</p></td>
              <td colspan="2"><p>{{ $record->kidney_yang}}</p></td>
              <td class="warning"><p>Kidney (yin)</p></td>
              <td colspan="2"><p>{{ $record->kidney_yin}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>TCM Disease</p></td>
              <td colspan="5"><p>{{ $record->TCM_disease}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>TCM Type / Pattern</p></td>
              <td colspan="5"><p>{{ $record->TCM_type}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Treatment Principle</p></td>
              <td colspan="5"><p>{{ $record->treatment_principle}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Acu-points & Techniques/s & Methods/s</p></td>
              <td colspan="5"><p>{{ $record->Acu_points}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Explanation Of Treatment</p></td>
              <td colspan="5"><p>{{ $record->treatment_explanation}}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Cautions, Contraindications and Red Flag</p></td>
              <td colspan="5"><p>{{ $record->cautions }}</p></td>
            </tr>
            <tr>
              <td class="warning"><p>Post Treatment Advice</p></td>
              <td colspan="5"><p>{{ $record->treatment_adjustments}}</p></td>
            </tr>
            <tr style="height:75px;">
              <td class="warning">
                Signature
              </td>
              <td colspan="2">

              </td>
              <td class="warning">
                Date
              </td>
              <td colspan="2">

              </td>
            </tr>
          </table>
        </div>
    </div>
</div>
@endsection
