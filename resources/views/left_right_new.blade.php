@extends('layouts.app')

@section('assets')
<!-- <link rel="stylesheet" href="/Users/vinaychetnani/Desktop/bootstrap-select-1.13.2/dist/css/bootstrap-select.min.css"> -->
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.min.css') }}" />
<style>
table { table-layout: fixed; }
/*table th, table td { overflow: hidden; }*/
/*#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}*/
.table tbody tr.success {
  background-color: #42f44b !important;
}

.table tbody tr.error {
  background-color: #ef2f3c !important;
}

.table tbody tr > td.success {
  background-color: #42f44b !important;
}

.table tbody tr > td.error {
  background-color: #ef2f3c !important;
}

/*#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}*/
/*
#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}*/

/*#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}*/
/*#hover_card:hover {background: #d6d4d4;}*/

/*.filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}*/

/*.filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}

.filters input[disabled]::-moz-placeholder {
    color: #333;
}

.filters input[disabled]:-ms-input-placeholder {
    color: #333;
}*/

</style>
@endsection



@section('content')
    <div class="panel panel-default" id="main_panel">
        <div style="padding-top: 20px; padding-bottom: 20px" class="panel-heading text-center">
            <h3>Resume Panel</h3>
        </div>
        <div class="panel-body">
    		<div class="container">
    			{!! Form::open(['route' => 'parseform']) !!}
    			<div class="row">
    				<div class="col-md-4">
        				<div class="form-group">
		                    {!! Form::label('r_id', 'Resume Id', ['class' => 'control-label']) !!}
		                    {!! Form::text('r_id', null, ['class' => 'form-control']) !!}
		                </div>
		            </div>

		            <div class="col-md-4">
		                <div class="form-group">
		                    {!! Form::label('benchmark', 'Benchmark', ['class' => 'control-label']) !!}
		                    {!! Form::text('benchmark', null, ['class' => 'form-control']) !!}
		                </div>
		            </div>

		            <div class="col-md-4">
		                <div class="form-group">
		                    {!! Form::label('community', 'Community', ['class' => 'control-label']) !!}
		                    {!! Form::text('community', null, ['class' => 'form-control']) !!}
		                </div>
		            </div>    
        		</div>

                {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

                {!! Form::close() !!}
        	</div>
            <hr>

            @if ($json_s == True)
            	<div class="row">
            		<div class="col-md-6"><input type="text" class="form-control" placeholder="Search Bullet" id="bullet_search"></div>
            		<div class="col-md-6"><input type="text" class="form-control" placeholder="Search Competencies" id="comp_search"></div>
            	</div>
            	<hr>
                @foreach($json as $key => $t)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-dark" id="hover_card">
                                <div class="card-body" role="tab" >
                                	<div class="row">
                                		<div class="col-md-6">
                                    		<div class="collapsed bullet_search_class_div" id={{ 'bullet'.$t['merged_id'] }} role="button" data-toggle="collapse" href={{ '#bullet_description'.$t['merged_id'] }} aria-expanded="false" aria-controls={{ '#bullet_description'.$t['merged_id'] }}>
                                        		{{$t['merged_id'].'.   '.$t['text']}}
                                    		</div>
                                    		<div style="padding-top: 15px">
                                    			<button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal2" id={{ 'positive_phrase_'.$key }}>Positive-Phrase</button>
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="collapsed comp_search_class_div" id={{ 'comp'.$t['merged_id'] }} role="button" data-toggle="collapse" href={{ '#comp_description'.$t['merged_id'] }} aria-expanded="false" aria-controls={{ '#comp_description'.$t['merged_id'] }}>
                                        		@if (sizeof($all_c[$key][0]) == 0)
                                        			<a>...</a>
                                    			@else
                                        			<table class="table table-striped">
                                        				<tr>
                                        					<th>Competency Name</th>
                                        					<th>Position</th>
                                        					<th>Action</th>
                                        				</tr>
                                            			@foreach($all_c[$key][0] as $key_comp => $t_comp)
                                                			<tr>
                                                    			<td>{{ $t_comp}}</td>
                                                    			<td>{{ $all_c[$key][1][$key_comp] }}</td>
                                                    			<td>{{ $all_c[$key][2][$key_comp] }}</td>
                                                			</tr>
                                            			@endforeach
                                       				</table>
                                    			@endif
                                    		</div>
                                    	</div>
                                    </div>
                                </div>
                                <div id={{ 'bullet_description'.$t['merged_id'] }} class="panel-collapse collapse" role="tabpanel" aria-labelledby={{ '#bullet'.$t['merged_id'] }}>
                                    <table class="table table-striped table-bordered">
                                    	@foreach($t as $key_extra => $t_extra)
	                                    	@if ($key_extra == "action" or $key_extra == "position" or $key_extra == "skills_output" or $key_extra == "text" or $key_extra == "merged_id")
	                                    	    @continue
	                                    	@elseif ($key_extra == "is_content")
		                                    	<tr>
		                                            <td>is_content</td>
		                                            <td>
		                                            	@if ($t['is_content'])
		                                            		<a>true</a>
		                                            	@else
		                                            		<a>false</a>
		                                            	@endif
		                                            </td>
		                                        </tr>
	                                        @else
		                                        <tr>
		                                            <td>{{ $key_extra }}</td>
		                                            <td>{{ (is_array($t_extra)) ? json_encode($t_extra) : $t_extra }}</td>
		                                        </tr>
	                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                                <div id={{ 'comp_description'.$t['merged_id'] }} class="panel-collapse collapse in" role="tabpanel" aria-labelledby={{ '#comp'.$t['merged_id'] }}>
                                    <table class="table table-striped table-bordered" id={{ 'try_table_'.$key }}>
                                        <thead>
                                        	<tr>
	                                            <th style="width: 16.66%"><input type="text" class="form-control" placeholder="Verb" id={{ 'myInput_verb_'.$key }}></th>
	                                            <th style="width: 16.66%"><input type="text" class="form-control" placeholder="Noun" id={{ 'myInput_noun_'.$key }}></th>
	                                            <th style="width: 25%"><input type="text" class="form-control" placeholder="Hard Skills" id={{ 'myInput_hs_'.$key }}></th>
	                                            <th style="width: 25%"><input type="text" class="form-control" placeholder="Soft Skills" id={{ 'myInput_ss_'.$key }}></th>
	                                            <th style="width: 16.66%"><input type="text" class="form-control" placeholder="Competencies" id={{ 'myInput_comp_'.$key }}></th>
	                                        </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($t['skills_output'] as $key_out => $t_out)
	                                        <tr class="collapsed ele" id={{ 'sub_comp_'.$key.'_'.$key_out }} role="button" data-toggle="collapse" href={{ '#sub_comp_description_'.$key.'_'.$key_out }} aria-expanded="false" aria-controls= {{ '#sub_comp_description_'.$key.'_'.$key_out }}>

	                                            <td class="ele_td_verb">{{ $t_out[0] }}</td>
	                                            <td class="ele_td_noun"><a>{{ $t_out[1] }}</a></td>
	                                            <td class="ele_td_hs">
	                                                <div>
		                                                <table class="table">
		                                                    @foreach($t_out[2] as $key_hs => $t_hs)
		                                                        <tr>
		                                                            <td>{{ $t_hs }}</td>
		                                                        </tr>
		                                                    @endforeach
		                                                </table>
	                                            	</div>
	                                            </td>
	                                            <td class="ele_td_ss">
	                                                    <table class="table">
	                                                        @foreach($t_out[3] as $key_ss => $t_ss)
	                                                            <tr>
	                                                                <td>{{ $t_ss }}</td>
	                                                            </tr>
	                                                        @endforeach
	                                                    </table>
	                                            </td>
	                                            <td class="ele_td_comp">
	                                                    <table class="table">
	                                                        @foreach($t_out[4] as $key_subcomp => $t_subcomp)
	                                                            <tr>
	                                                                <td>{{ $t_subcomp }}</td>
	                                                            </tr>
	                                                        @endforeach
	                                                    </table>
	                                            </td>
	                                        </tr>
	                                        <tr class="hiddenRow collapse in table-responsive" id={{ 'sub_comp_description_'.$key.'_'.$key_out }} role="tabpanel" aria-labelledby={{ 'sub_comp_'.$key.'_'.$key_out }}>
	                                        	<td colspan="12">
	                                        		<div>
					                                	<table class="table" id={{ 'try_table_'.$key.'_'.$key_out }}>
					                                		<thead>
					                                			<tr>
						                                			<th style="width: 16.66%"><input type="text" class="form-control" placeholder="Source" id={{ 'subMyInput_source_'.$key.'_'.$key_out }}></th>
						                                			<th style="width: 16.66%"><input type="text" class="form-control" placeholder="Components" id={{ 'subMyInput_components_'.$key.'_'.$key_out }}></th>
						                                			<th style="width: 25%"><input type="text" class="form-control" placeholder="Hard Skills" id={{ 'subMyInput_hs_'.$key.'_'.$key_out }}></th>
						                                			<th style="width: 25%"><input type="text" class="form-control" placeholder="Soft Skills" id={{ 'subMyInput_ss_'.$key.'_'.$key_out }}></th>
						                                			<th style="width: 16.66%"><input type="text" class="form-control" placeholder="Competencies" id={{ 'subMyInput_comp_'.$key.'_'.$key_out }}></th>
						                                		</tr>
					                                		</thead>
					                                		<tbody>
					                                			@foreach($t_out[5] as $key_sub_sub => $t_sub_sub)
						                                		<tr class="ele_sub_table" data-toggle="modal" data-target="#exampleModal" id={{ 'subMyInput_'.$key.'_'.$key_out.'_'.$key_sub_sub }}>
						                                			<td class="sub_ele_td_source"><span style="font-weight:bold">{{ $t_sub_sub[0] }}</span></td>
						                                			<td class="sub_ele_td_components">
						                                				<div>
							                                				<table class="table">
							                                					@foreach($t_sub_sub[1] as $key_sub_sub_1 => $t_sub_sub_1)
			                                                            			<tr>
			                                                            				<td><span style="font-weight:bold">{{ $key_sub_sub_1 }}</span></td>
			                                                                			<td>{{ $t_sub_sub_1 }}</td>
			                                                            			</tr>
			                                                        			@endforeach
							                                				</table>
						                                				</div>
						                                			</td>
						                                			<td class="sub_ele_td_hs">
						                                				<div>
						                                					@if (sizeof($t_sub_sub[2]['hard']) == 0)
		                                                    					<a></a>
		                                                					@else
								                                				<table class="table">
								                                					@foreach($t_sub_sub[2]['hard'] as $key_sub_sub_hard => $t_sub_sub_hard)
				                                                            			<tr>
				                                                                			<td>
			                                                            						{{ $t_sub_sub_hard}}
				                                                                			</td>
				                                                            			</tr>
				                                                        			@endforeach
								                                				</table>
								                                			@endif
						                                				</div>
						                                			</td>
						                                			<td class="sub_ele_td_ss">
						                                				<div>
						                                					@if (sizeof($t_sub_sub[2]['soft']) == 0)
		                                                    					<a></a>
		                                                					@else
								                                				<table class="table">
								                                					@foreach($t_sub_sub[2]['soft'] as $key_sub_sub_soft => $t_sub_sub_soft)
				                                                            			<tr>
				                                                                			<td>
			                                                            						{{ $t_sub_sub_soft}}
				                                                                			</td>
				                                                            			</tr>
				                                                        			@endforeach
								                                				</table>
								                                			@endif
						                                				</div>
						                                			</td>
						                                			<td class="sub_ele_td_comp">
						                                				<div>
						                                					@if (sizeof($t_sub_sub[2]['comp']) == 0)
		                                                    					<a></a>
		                                                					@else
								                                				<table class="table">
								                                					@foreach($t_sub_sub[2]['comp'] as $key_sub_sub_comp => $t_sub_sub_comp)
				                                                            			<tr>
				                                                                			<td>
			                                                            						{{ $t_sub_sub_comp}}
				                                                                			</td>
				                                                            			</tr>
				                                                        			@endforeach
								                                				</table>
								                                			@endif
						                                				</div>
						                                			</td>
						                                		</tr>
						                                		@endforeach
					                                		</tbody>
					                                	</table>
					                                </div>
	                                        	</td>
	                                        </tr>
	                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr>
        		<div style="padding-bottom: 10px; text-align: center">
        			<button type="submit" class="btn btn-primary" id="review_changes">
                		Review Changes
            		</button>
        		</div>
            @else
            	<div class="row">
            		<p>Error occurred while processing resume id</p>
            	</div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel">Editor</h5>
      			</div>
	      		<div class="modal-body">
	        		<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
  						<li class="nav-item">
    						<a class="nav-link active" id="remove_hs-tab" data-toggle="tab" href="#remove_hs" role="tab" aria-controls="remove_hs" aria-selected="true">Remove HS</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" id="add_hs-tab" data-toggle="tab" href="#add_hs" role="tab" aria-controls="add_hs" aria-selected="false">Add HS</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" id="remove_ss-tab" data-toggle="tab" href="#remove_ss" role="tab" aria-controls="remove_ss" aria-selected="false">Remove SS</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" id="add_ss-tab" data-toggle="tab" href="#add_ss" role="tab" aria-controls="add_ss" aria-selected="false">Add SS</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" id="remove_hs_ss-tab" data-toggle="tab" href="#remove_hs_ss" role="tab" aria-controls="remove_hs_ss" aria-selected="true">Remove HS-SS</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" id="make_anti_phrase_vn-tab" data-toggle="tab" href="#make_anti_phrase_vn" role="tab" aria-controls="make_anti_phrase_vn" aria-selected="true">Anti-Phrase</a>
  						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
	  					<div class="tab-pane fade show active" id="remove_hs" role="tabpanel" aria-labelledby="remove_hs-tab">Not allowed in this case</div>
	  					<div class="tab-pane fade" id="add_hs" role="tabpanel" aria-labelledby="add_hs-tab">Not allowed in this case</div>
	  					<div class="tab-pane fade" id="remove_ss" role="tabpanel" aria-labelledby="remove_ss-tab">Not allowed in this case</div>
	  					<div class="tab-pane fade" id="add_ss" role="tabpanel" aria-labelledby="add_ss-tab">Not allowed in this case</div>
	  					<div class="tab-pane fade" id="remove_hs_ss" role="tabpanel" aria-labelledby="remove_hs_ss-tab">Not allowed in this case</div>
	  					<div class="tab-pane fade" id="make_anti_phrase_vn" role="tabpanel" aria-labelledby="make_anti_phrase_vn-tab">Not allowed in this case</div>
					</div>
	     		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      		</div>
    		</div>
  		</div>
  	</div>


  	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  		<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel1">Editor</h5>
      			</div>
	      		<div class="modal-body">
	        		<ul class="nav nav-tabs nav-fill" id="myTab1" role="tablist">
  						<li class="nav-item">
    						<a class="nav-link active" id="add_comp-tab" data-toggle="tab" href="#add_comp" role="tab" aria-controls="add_comp" aria-selected="true">Add Competency</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" id="remove_comp-tab" data-toggle="tab" href="#remove_comp" role="tab" aria-controls="remove_comp" aria-selected="false">Remove Competency</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" id="make_anti_phrase-tab" data-toggle="tab" href="#make_anti_phrase_logic" role="tab" aria-controls="make_anti_phrase_logic" aria-selected="false">Make Anti-Phrase</a>
  						</li>
					</ul>
					<div class="tab-content" id="myTabContent1">
	  					<div class="tab-pane fade show active" id="add_comp" role="tabpanel" aria-labelledby="add_comp-tab">Not allowed in this case</div>
	  					<div class="tab-pane fade" id="remove_comp" role="tabpanel" aria-labelledby="remove_comp-tab">Not allowed in this case</div>
	  					<div class="tab-pane fade" id="make_anti_phrase_logic" role="tabpanel" aria-labelledby="make_anti_phrase_logic-tab">Not allowed in this case</div>
					</div>
	     		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      		</div>
    		</div>
  		</div>
  	</div>

  	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  		<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel2">Make Positive Phrase</h5>
      			</div>
	      		<div class="modal-body">
	        		<ul class="nav nav-tabs nav-fill" id="myTab2" role="tablist">
  						<li class="nav-item">
    						<a class="nav-link active" id="pos_phrase_category-tab" data-toggle="tab" href="#pos_phrase_category" role="tab" aria-controls="pos_phrase_category" aria-selected="true">Category</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" id="pos_phrase_datapanel-tab" data-toggle="tab" href="#pos_phrase_datapanel" role="tab" aria-controls="pos_phrase_datapanel" aria-selected="false">Data Panel</a>
  						</li>
					</ul>
					<div class="tab-content" id="myTabContent2">
	  					<div class="tab-pane fade show active" id="pos_phrase_category" role="tabpanel" aria-labelledby="pos_phrase_category-tab">
	  						<div>
	  							<div style="padding-top: 10px">
	  								<input type="text" class="form-control" value="" id="pos_phrase_category_bullet_input">
	  							</div>
	  							<div style="padding-top: 15px">
	  								<a style="font-size: 15px">Select Category</a>
	  							</div>
	  							<hr>
	  							<div class="container">
	  								<div class="row">
	  									<div class="col-md-12">
	  										<select id="pos_phrase_select_category">
	  											<option>software_knowledge</option>
	  											<option>societies_clubs</option>
	  											<option>positions_of_responsibility</option>
	  											<option>programming_language</option>
	  											<option>academic_excellence</option>
	  											<option>certifications</option>
	  											<option>course_name</option>
	  											<option>tools_skills</option>
	  										</select>
	  									</div>
	  								</div>
	  							</div>
	  							<div style="padding-top:15px">
	  								<button type="button" class="btn btn-secondary" id="pos_phrase_category_button" name="">ADD</button>
	  							</div>
	  						</div>
	  					</div>
	  					<div class="tab-pane fade" id="pos_phrase_datapanel" role="tabpanel" aria-labelledby="pos_phrase_datapanel-tab">
	  						<div>
	  							<div style="padding-top: 10px">
	  								<input type="text" class="form-control" value="" id="pos_phrase_datapanel_bullet_input">
	  							</div>
	  							<div class="container">
	  								<div class="row">
	  									<div class="col-md-6">
	  										<div style="padding-top: 15px">
	  											<a style="font-size: 15px">Select Category</a>
	  										</div>
	  										<hr>
	  										<select id="pos_phrase_select_data_panel">
	  											<option>concentration</option>
	  											<option>functional_area</option>
	  											<option>job_role</option>
	  										</select>
	  									</div>
	  									<div class="col-md-6">
	  										<div style="padding-top: 15px">
	  											<a style="font-size: 15px">Select Competencies</a>
	  										</div>
	  										<hr>
	  										<select multiple="multiple" style="width: 200px" id="pos_phrase_select_comp_data_panel" size="5">
	  											<option>Analytical</option>
	  											<option>Communication</option>
	  											<option>Initiative</option>
	  											<option>Leadership</option>
	  											<option>Teamwork</option>
	  										</select>
	  									</div>
	  								</div>
	  							</div>
	  							<div style="padding-top:15px">
	  								<button type="button" class="btn btn-secondary" id="pos_phrase_data_panel_button" name="">ADD</button>
	  							</div>
	  						</div>
	  					</div>
					</div>
	     		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      		</div>
    		</div>
  		</div>
  	</div>

  	<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  		<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel3">Make Anti-VN</h5>
      			</div>
	      		<div class="modal-body">
	        		<div>Not allowed in this case</div>
	     		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      		</div>
    		</div>
  		</div>
  	</div>

  	<div class="panel panel-default d-none" id="review_panel">
        <div style="padding-top: 20px; padding-bottom: 20px" class="panel-heading text-center">
            <h3>Review Changes</h3>
        </div>
        <div class="panel-body">
			<div class="row">
				<div class="col-md-12" role="tabpanel">
	  				<table class="table table-striped table-bordered table-responsive" id="review_table">
	  					<thead>
	  						<th style="width: 12.66%">Source</th>
	  						<th style="width: 16.66%">Components</th>
	  						<th style="width: 25%">Hard-Skill</th>
	  						<th style="width: 25%">Soft-Skill</th>
	  						<th style="width: 16.66%"S>Competency</th>
	  						<th style="width: 4%">Remove</th>
	  					</thead>
	  					<tbody></tbody>
	  				</table>
  				</div>
  			</div>
		</div>
	</div>
@endsection


@section('scripts')
<!-- <script src="/Users/vinaychetnani/Desktop/bootstrap-select-1.13.2/dist/js/bootstrap-select.min.js"></script> -->
<script src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
<script>
// function myFunction_verb() {
//   var input, filter, table, tr, td, i;
//   input = document.getElementById("myInput_verb8");
//   filter = input.value.toUpperCase();
//   table = document.getElementById("try_table8");
//   tr = table.getElementsByClassName("ele");
//   for (i = 0; i < $(tr).length; i++) {
//     td = tr[i].getElementsByTagName("td")[0];
//     if (td) {
//       if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
//         tr[i].style.display = "";
//       } else {
//         tr[i].style.display = "none";
//       }
//     }       
//   }
// }

$('.selectpicker').selectpicker();

$(document).ready(function(){
	var useful_array = [["software_knowledge", "Analytical"],["societies_clubs", "Teamwork"],["positions_of_responsibility", "Leadership"],["programming_language", "Analytical"],["academic_excellence", "Leadership"],["certifications", "Analytical"],["course_name", "Analytical"],["tools_skills", "Analytical"]];
	var all_trs = $(document.getElementsByClassName("ele_sub_table"));
	console.log(all_trs.length);
	$.each( all_trs, function( key, value ) {
		var tr_so = value.getElementsByClassName("sub_ele_td_source")[0].textContent;
		if (tr_so.split("_")[0] == "category" || tr_so.split("_")[0] == "data"){
			var req_id = $(value).attr("id");
			// console.log(req_id);
			var req_tr  = $(document.getElementById(req_id))
			req_tr.attr("data-target", "#exampleModal1");
			console.log(req_tr.attr("data-target"));
		}
		if (tr_so.split("_")[0] == "verb"){
			var req_id = $(value).attr("id");
			var req_tr  = $(document.getElementById(req_id));
			req_tr.attr("data-target", "#exampleModal3");
		}
	});


	var change_type_array = ["to_remove_hs", "to_remove_ss", "to_remove_hs_ss", "to_add_ss", "to_add_hs", "to_add_anti_phrase_vn", "to_remove_comp", "to_add_comp", "to_make_anti_phrase_category", "to_add_comp_data_panel", "to_remove_comp_data_panel", "to_make_anti_phrase_data_panel", "to_add_positive_phrase_category","to_add_positive_phrase_datapanel", "to_make_anti_vn_soft", "to_make_anti_vn_hard"];



	$("#review_changes").click(function (){
		var rev_panel = document.getElementById("review_panel");
		var rev_panel_tbody = rev_panel.getElementsByTagName("tbody")[0];
		var index_id = 0;

		var all_type_trs = $(document.getElementsByClassName("to_remove_hs"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_remove_hs error\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_remove_ss"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_remove_ss error\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_remove_hs_ss"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_remove_hs_ss\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_add_hs"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_add_hs success\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_add_ss"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_add_ss success\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_add_anti_phrase_vn"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_add_anti_phrase_vn error\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_remove_comp"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_remove_comp error\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_add_comp"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_add_comp success\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_make_anti_phrase_category"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_make_anti_phrase_category error\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_add_comp_data_panel"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_add_comp_data_panel success\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_remove_comp_data_panel"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_remove_comp_data_panel\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_make_anti_phrase_data_panel"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_make_anti_phrase_data_panel error\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_add_positive_phrase_category"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_add_positive_phrase_category success\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_add_positive_phrase_datapanel"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_add_positive_phrase_datapanel success\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_make_anti_vn_soft"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_make_anti_vn_soft error\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		var all_type_trs = $(document.getElementsByClassName("to_make_anti_vn_hard"));
		$.each( all_type_trs, function(key_tr, value_tr) {
			var rev_tr = "<tr class=\"to_make_anti_vn_hard error\" id=\"review_tr_" + index_id + "\">" + value_tr.innerHTML + "<td><button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"remove_review_tr_button\" name=\"" +  index_id + "\">X</button></td></tr";
			rev_panel_tbody.innerHTML += rev_tr;
			index_id += 1;
		});
		$(document.getElementById("main_panel")).addClass("d-none");
		$(document.getElementById("review_panel")).removeClass("d-none");
			// var tr_so = value.getElementsByClassName("sub_ele_td_source")[0].textContent;
			// if (tr_so.split("_")[0] == "category" || tr_so.split("_")[0] == "data"){
			// 	var req_id = $(value).attr("id");
			// 	// console.log(req_id);
			// 	var req_tr  = $(document.getElementById(req_id))
			// 	req_tr.attr("data-target", "#exampleModal1");
			// 	console.log(req_tr.attr("data-target"));
			// }
			// if (tr_so.split("_")[0] == "verb"){
			// 	var req_id = $(value).attr("id");
			// 	var req_tr  = $(document.getElementById(req_id));
			// 	req_tr.attr("data-target", "#exampleModal3");
			// }
	});


	$("#review_table").delegate("#remove_review_tr_button", "click", function(){
		var but_name = $(this).attr("name");
		console.log(but_name);
		// var rev_panel = document.getElementById("review_panel");
		// var rev_panel_tbody = rev_panel.getElementsByTagName("tbody")[0];
		var review_tr = $(document.getElementById("review_tr_" + but_name));
		review_tr.addClass("d-none");
	});


	$('#exampleModal').on('show.bs.modal', function (event) {
  		var button = $(event.relatedTarget) // Button that triggered the modal
  		var trId = button.attr("id")
  		// console.log(trId)
  		var trReq = document.getElementById(trId)
  		var bull_id = "bullet" + trId.split('_')[1];
  		var id_back = trId.split('_')[1] + "_" + trId.split('_')[2] + "_" + trId.split('_')[3];
  		var col0 = trReq.getElementsByClassName("sub_ele_td_source")[0]
  		var col1 = trReq.getElementsByClassName("sub_ele_td_components")[0]
  		var col2 = trReq.getElementsByClassName("sub_ele_td_hs")[0]
  		var col3 = trReq.getElementsByClassName("sub_ele_td_ss")[0]
  		var compo_lis = col1.getElementsByTagName("td")
  		// console.log(compo_lis[1].textContent)
  		var hs_lis = col2.getElementsByTagName("td")
  		var ss_lis = col3.getElementsByTagName("td")
  		console.log(ss_lis.length)
		var modal = $(this)
		modal.find('.modal-title').text('Editing in ' + col0.textContent)
		// var tab_body = modal.find("#myTabContent")
		modal.find('#remove_hs').html('<a>Not allowed in this case</a>')
		modal.find('#add_ss').html('<a>Not allowed in this case</a>')
		modal.find('#add_hs').html('<a>Not allowed in this case</a>')
		modal.find('#remove_ss').html('<a>Not allowed in this case</a>')
		modal.find('#remove_hs_ss').html('<a>Not allowed in this case</a>')
		if (col0.textContent === "vn_db_search"){
  			modal.find('.modal-title').text("Editing in " + col0.textContent);
  			var div_contents_hs_add = "<div><div style=\"padding-top: 15px\"><a style=\"font-size: 15px\">Add HARD-SKILL to &nbsp;&nbsp;<b><u>"  + compo_lis[1].textContent + "&nbsp;&nbsp;" + compo_lis[3].textContent + "</u></b></a></div><hr><input type=\"text\" class=\"form-control\" placeholder=\"\" id=\"add_hs_input\"><div style=\"padding-top:15px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"modal_add_hs_button\" name=\"" +  id_back + "\">ADD</button></div></div>";
  			var div_contents_ss_add = "<div><div style=\"padding-top: 15px\"><a style=\"font-size: 15px\">Add SOFT-SKILL to &nbsp;&nbsp;<b><u>"  + compo_lis[1].textContent + "&nbsp;&nbsp;" + compo_lis[3].textContent + "</u></b></a></div><hr><div class=\"container\"><div class=\"row\"><div class=\"col-md-12\"><select data-live-search=\"true\" class=\"selectpicker\" id=\"ss_add_select\" data-title=\"Select Soft-Skill\"><option data-tokens=\"Analytical Skills\">Analytical Skills</option><option data-tokens=\"Building Relationships\">Building Relationships</option><option data-tokens=\"Client focused\">Client focused</option><option data-tokens=\"Collaboration\">Collaboration</option><option data-tokens=\"Collaborative Leadership\">Collaborative Leadership</option><option data-tokens=\"Communication Skills\">Communication Skills</option><option data-tokens=\"Conceptual Thinking\">Conceptual Thinking</option><option data-tokens=\"Conflict Management\">Conflict Management</option><option data-tokens=\"Coordinating Activities\">Coordinating Activities</option><option data-tokens=\"Creative Skills\">Creative Skills</option><option data-tokens=\"Creative thinking\">Creative thinking</option><option data-tokens=\"Critical Thinking\">Critical Thinking</option><option data-tokens=\"Cross-cultural Teaming\">Cross-cultural Teaming</option><option data-tokens=\"Cross-functional Team Leadership\">Cross-functional Team Leadership</option><option data-tokens=\"Customer Oriented\">Customer Oriented</option><option data-tokens=\"Dealing with ambiguity\">Dealing with ambiguity</option><option data-tokens=\"Detail Oriented\">Detail Oriented</option><option data-tokens=\"Entrepreneurial skills\">Entrepreneurial skills</option><option data-tokens=\"Facilitation\">Facilitation</option><option data-tokens=\"Global Leadership\">Global Leadership</option><option data-tokens=\"Idea Generation\">Idea Generation</option><option data-tokens=\"Influencing People and Outcomes\">Influencing People and Outcomes</option><option data-tokens=\"Initiative\">Initiative</option><option data-tokens=\"Innovation\">Innovation</option><option data-tokens=\"Innovation Management\">Innovation Management</option><option data-tokens=\"Intercultural Skills\">Intercultural Skills</option><option data-tokens=\"Interpersonal skills\">Interpersonal skills</option><option data-tokens=\"Investigative\">Investigative</option><option data-tokens=\"Lateral Thinking\">Lateral Thinking</option><option data-tokens=\"Leadership\">Leadership</option><option data-tokens=\"Liaisoning\">Liaisoning</option><option data-tokens=\"Management Coaching\">Management Coaching</option><option data-tokens=\"Management Skills\">Management Skills</option><option data-tokens=\"Mathematical Reasoning\">Mathematical Reasoning</option><option data-tokens=\"Mentoring\">Mentoring</option><option data-tokens=\"Motivational skills\">Motivational skills</option><option data-tokens=\"Multilingual\">Multilingual</option><option data-tokens=\"Multitasking\">Multitasking</option><option data-tokens=\"Natural Leadership\">Natural Leadership</option><option data-tokens=\"Negotiation\">Negotiation</option><option data-tokens=\"Networking\">Networking</option><option data-tokens=\"Peer Support\">Peer Support</option><option data-tokens=\"People Development\">People Development</option><option data-tokens=\"People Management\">People Management</option><option data-tokens=\"Personal Coaching\">Personal Coaching</option><option data-tokens=\"Persuasion skills\">Persuasion skills</option><option data-tokens=\"Planning\">Planning</option><option data-tokens=\"Practical Thinking\">Practical Thinking</option><option data-tokens=\"Presentation Skills\">Presentation Skills</option><option data-tokens=\"Problem Solving\">Problem Solving</option><option data-tokens=\"Public Speaking\">Public Speaking</option><option data-tokens=\"Quantitative Aptitude\">Quantitative Aptitude</option><option data-tokens=\"Reasoning Skills\">Reasoning Skills</option><option data-tokens=\"Record Of Success\">Record Of Success</option><option data-tokens=\"Relationship Building/ Management\">Relationship Building/ Management</option><option data-tokens=\"Relationship Management\">Relationship Management</option><option data-tokens=\"Stakeholder Engagement\">Stakeholder Engagement</option><option data-tokens=\"Strategic Thinking\">Strategic Thinking</option><option data-tokens=\"Structured Problem Solving\">Structured Problem Solving</option><option data-tokens=\"Team building\">Team building</option><option data-tokens=\"Team Leadership\">Team Leadership</option><option data-tokens=\"Team management\">Team management</option><option data-tokens=\"Teamwork\">Teamwork</option><option data-tokens=\"Technical Leadership\">Technical Leadership</option><option data-tokens=\"Time Management\">Time Management</option><option data-tokens=\"Time tracking\">Time tracking</option><option data-tokens=\"Timely Delivery\">Timely Delivery</option><option data-tokens=\"Timely Execution\">Timely Execution</option><option data-tokens=\"Verbal Communication\">Verbal Communication</option><option data-tokens=\"Visual Communication\">Visual Communication</option><option data-tokens=\"Written Communication\">Written Communication</option></select></div></div></div><div style=\"padding-top:10px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"modal_add_ss_button\" name=\"" +  id_back + "\">ADD</button></div></div>";
  			modal.find('#add_ss').html(div_contents_ss_add);
  			$(".selectpicker").selectpicker('refresh')
			modal.find('#add_hs').html(div_contents_hs_add);
  			if (hs_lis.length == 1 && ss_lis.length == 0){
  				var corr_bull = $('#' + bull_id).text();
  				var corr_bull1 = jQuery.trim(corr_bull);
  				console.log(corr_bull1);
  				var div_contents = "<div style=\"padding-top: 15px\" class=\"container\"><div class=\"row\"><div class=\"col-md-9\"><a style=\"font-size: 15px\">Remove HARD-SKILL &nbsp;&nbsp;<b><u>" + hs_lis[0].textContent + "</u></b>&nbsp;&nbsp; from &nbsp;&nbsp;<b><u>"  + compo_lis[1].textContent + "&nbsp;&nbsp;" + compo_lis[3].textContent + "</u></b></a></div><div class=\"col-md-3\"><button type=\"button\" class=\"btn btn-secondary\" id=\"modal_remove_hs_button\" name=\"" +  id_back + "\">REMOVE</button></div></div></div>";
  				var anti_phrase_contents = "<div><div style=\"padding-top: 10px\"><input type=\"text\" class=\"form-control\" value=\""+ corr_bull1 + "\" id=\"anti_phrase_bullet_description\"></div><div style=\"padding-top: 10px\" class=\"row\"><div class=\"col-md-3\">HARD-SKILL</div><div class=\"col-md-3\"><u><b>" + hs_lis[0].textContent + "</u></b></div></div><div style=\"padding-top: 10px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"make_anti_phrase_vn_button\" name=\"" +  id_back + "_hs" + "\">MAKE ANTI-PHRASE</button></div></div>";
  				modal.find('#remove_hs').html(div_contents)
  				modal.find('#remove_ss').html('<a>Not allowed in this case</a>')
  				modal.find('#make_anti_phrase_vn').html(anti_phrase_contents)
  				modal.find('#remove_hs_ss').html('<a>Not allowed in this case</a>')
  			}
  			if (hs_lis.length == 0 && ss_lis.length == 1){
  				var corr_bull = $('#' + bull_id).text();
  				var corr_bull1 = jQuery.trim(corr_bull);
  				console.log(corr_bull1);
  				var div_contents = "<div style=\"padding-top: 15px\" class=\"container\"><div class=\"row\"><div class=\"col-md-9\"><a style=\"font-size: 15px\">Remove SOFT-SKILL &nbsp;&nbsp;<b><u>" + ss_lis[0].textContent + "</u></b>&nbsp;&nbsp; from &nbsp;&nbsp;<b><u>"  + compo_lis[1].textContent + "&nbsp;&nbsp;" + compo_lis[3].textContent + "</u></b></a></div><div class=\"col-md-3\"><button type=\"button\" class=\"btn btn-secondary\" id=\"modal_remove_ss_button\" name=\"" +  id_back + "\">REMOVE</button></div>";
  				var anti_phrase_contents = "<div><div style=\"padding-top: 10px\"><input type=\"text\" class=\"form-control\" value=\""+ corr_bull1 + "\" id=\"anti_phrase_bullet_description\"></div><div style=\"padding-top: 10px\" class=\"row\"><div class=\"col-md-3\">SOFT-SKILL</div><div class=\"col-md-3\"><u><b>" + ss_lis[0].textContent + "</u></b></div></div><div style=\"padding-top: 10px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"make_anti_phrase_vn_button\" name=\"" +  id_back + "_ss" + "\">MAKE ANTI-PHRASE</button></div></div>";
  				modal.find('#remove_hs').html('<a>Not allowed in this case</a>')
  				modal.find('#remove_ss').html(div_contents)
  				modal.find('#make_anti_phrase_vn').html(anti_phrase_contents)
  				modal.find('#remove_hs_ss').html('<a>Not allowed in this case</a>')
  			}
  			if (hs_lis.length >= 1 && ss_lis.length == 1){
  				var div_contents = "<div style=\"padding-top: 15px\" class=\"container\"><div class=\"row\"><div class=\"col-md-9\"><a style=\"font-size: 15px\">Remove HARD-SKILL &nbsp;&nbsp;<b><u>" + hs_lis[(hs_lis.length)-1].textContent + "</u></b>&nbsp;&nbsp; to SOFT-SKILL &nbsp;&nbsp;<b><u>" + ss_lis[0].textContent + "</u></b>&nbsp;&nbsp; relation from &nbsp;&nbsp;<b><u>"  + compo_lis[1].textContent + "&nbsp;&nbsp;" + compo_lis[3].textContent + "</u></b></a></div><div class=\"col-md-3\"><button type=\"button\" class=\"btn btn-secondary\" id=\"modal_remove_hs_ss_button\" name=\"" +  id_back + "\">REMOVE</button></div>";
  				modal.find('#remove_hs').html('<a>Not allowed in this case</a>')
  				modal.find('#remove_ss').html('<a>Not allowed in this case</a>')
  				modal.find('#remove_hs_ss').html(div_contents)
  			}
  		}
  		// Extract info from data-* attributes
  		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  		// var modal = $(this)
  		// modal.find('.modal-title').text('Editing' + col0.textContent)
  		// modal.find('.modal-body input').val(trId)
	});

$('#exampleModal1').on('show.bs.modal', function (event) {
  		var button = $(event.relatedTarget) // Button that triggered the modal
  		var trId = button.attr("id")
  		// console.log(trId)
  		var trReq = document.getElementById(trId)
  		var bull_id = "bullet" + trId.split('_')[1];
  		var id_back = trId.split('_')[1] + "_" + trId.split('_')[2] + "_" + trId.split('_')[3];
  		var col0 = trReq.getElementsByClassName("sub_ele_td_source")[0]
  		var col1 = trReq.getElementsByClassName("sub_ele_td_components")[0]
  		// var col2 = trReq.getElementsByClassName("sub_ele_td_hs")[0]
  		// var col3 = trReq.getElementsByClassName("sub_ele_td_ss")[0]
  		var col4 = trReq.getElementsByClassName("sub_ele_td_comp")[0]
  		var compo_lis = col1.getElementsByTagName("td")
  		var comp_lis = col4.getElementsByTagName("td")[0]
  		// console.log(compo_lis[1].textContent)
  		// var hs_lis = col2.getElementsByTagName("td")
  		// var ss_lis = col3.getElementsByTagName("td")
  		// console.log(ss_lis.length)
		var modal = $(this)
		// var tab_body = modal.find("#myTabContent")
		modal.find('#add_comp').html('<a>Not allowed in this case</a>')
		modal.find('#remove_comp').html('<a>Not allowed in this case</a>')
		modal.find('#make_anti_phrase_logic').html('<a>Not allowed in this case</a>')
		if (col0.textContent === "category_skills"){
  			modal.find('.modal-title').text("Editing in " + col0.textContent);
  			var corr_bull = $('#' + bull_id).text();
  			var corr_bull1 = jQuery.trim(corr_bull);
  			console.log(corr_bull1);
  			var div_contents_add_comp = "<div><div style=\"padding-top: 15px\"><a style=\"font-size: 15px\">Add new keyword to category &nbsp;&nbsp;<b><u>"  + compo_lis[3].textContent + "</u></b></a></div><hr><div class=\"container\"><div class=\"row\"><div class=\"col-md-12\"><select id=\"comp_add_select\"><option>" + useful_array[0][0] + "</option><option>" + useful_array[1][0] + "</option><option>" + useful_array[2][0] + "</option><option>" + useful_array[3][0] +"</option><option>" + useful_array[4][0] + "</option><option>" + useful_array[5][0] + "</option><option>" + useful_array[6][0] + "</option><option>" + useful_array[7][0] + "</option></select></div></div></div><div style=\"padding-top:15px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"modal1_add_comp_button\" name=\"" +  id_back + "\">ADD</button></div></div>";
  			var div_contents_remove_comp = "<div><div style=\"padding-top: 15px\"><a style=\"font-size: 15px\">Remove category &nbsp;&nbsp;<b><u>"  + compo_lis[1].textContent + "</u></b>&nbsp;&nbsp; from keyword &nbsp;&nbsp;<b><u>" + compo_lis[3].textContent + "</u></b></a></div><hr><div style=\"padding-top:10px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"modal1_remove_comp_button\" name=\"" +  id_back + "\">REMOVE</button></div></div>";
  			var div_contents_make_anti_phrase = "<div><div style=\"padding-top: 10px\"><input type=\"text\" class=\"form-control\" value=\""+ corr_bull1 + "\" id=\"anti_phrase_category_bullet_description\"></div><div style=\"padding-top: 10px\" class=\"row\"><div class=\"col-md-3\">Competency</div><div class=\"col-md-3\"><u><b>" + comp_lis.textContent + "</u></b></div></div><div style=\"padding-top: 10px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"make_anti_phrase_category_button\" name=\"" +  id_back  + "\">MAKE ANTI-PHRASE</button></div></div>";
  			modal.find('#add_comp').html(div_contents_add_comp);
			modal.find('#remove_comp').html(div_contents_remove_comp);
			modal.find('#make_anti_phrase_logic').html(div_contents_make_anti_phrase);
  		}
  		else if (col0.textContent.split('_')[0] === "data" ){
  			modal.find('.modal-title').text("Editing in " + col0.textContent);
  			var corr_bull = $('#' + bull_id).text();
  			var corr_bull1 = jQuery.trim(corr_bull);
  			console.log(corr_bull1);
  			var div_contents_add_comp = "<div><div style=\"padding-top: 15px\"><a style=\"font-size: 15px\">Add new Competency to keyword &nbsp;&nbsp;<b><u>"  + compo_lis[1].textContent + "</u></b></a></div><hr><div class=\"container\"><div class=\"row\"><div class=\"col-md-12\"><select multiple=\"multiple\" style=\"width: 200px\" size=\"5\" id=\"comp_add_select_data_panel\"><option>Analytical</option><option>Communication</option><option>Initiative</option><option>Leadership</option><option>Teamwork</option></select></div></div></div><div style=\"padding-top:15px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"modal1_add_comp_button_data_panel\" name=\"" +  id_back + "\">ADD</button></div></div>";

  			var all_comp_lis = col4.getElementsByTagName("td");
  			var all_comp_arr = [];
  			$.each(all_comp_lis, function(ke_td_dp, val_td_dp) { 
    			var te_comp = val_td_dp.innerText;
    			all_comp_arr.push(te_comp);
			});
			console.log(all_comp_arr[0])
  			var div_contents_remove_comp = "<div><div style=\"padding-top: 15px\"><a style=\"font-size: 15px\">Remove Competency from keyword &nbsp;&nbsp;<b><u>"  + compo_lis[1].textContent + "</u></b></a></div><hr><div class=\"container\"><div class=\"row\"><div class=\"col-md-12\"><select multiple=\"multiple\" style=\"width: 200px\" id=\"comp_remove_select_data_panel\">";
  			$.each(all_comp_arr, function(ke_comp_op, val_comp_op) { 
    			var option_comp = "<option>" + val_comp_op + "</option>";
    			div_contents_remove_comp += option_comp;
			});
			div_contents_remove_comp += "</select></div></div></div><div style=\"padding-top:10px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"modal1_remove_comp_button_data_panel\" name=\"" +  id_back + "\">REMOVE</button></div></div>";


  			var div_contents_make_anti_phrase = "<div><div style=\"padding-top: 10px\"><input type=\"text\" class=\"form-control\" value=\""+ corr_bull1 + "\" id=\"anti_phrase_data_panel_bullet_description\"></div><div style=\"padding-top: 15px\"><a style=\"font-size: 15px\"><a>Select Competencies to make Anti-Phrase</a></div><hr><div class=\"container\"><div class=\"row\"><div class=\"col-md-12\"><select multiple=\"multiple\" style=\"width: 200px\" id=\"comp_antiphrase_select_data_panel\">";
  			$.each(all_comp_arr, function(ke_comp_op, val_comp_op) { 
    			var option_comp = "<option>" + val_comp_op + "</option>";
    			div_contents_make_anti_phrase += option_comp;
			});
			div_contents_make_anti_phrase += "</select></div></div></div><div style=\"padding-top: 10px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"make_anti_phrase_data_panel_button\" name=\"" +  id_back  + "\">MAKE ANTI-PHRASE</button></div></div>";


  			modal.find('#add_comp').html(div_contents_add_comp);
			modal.find('#remove_comp').html(div_contents_remove_comp);
			modal.find('#make_anti_phrase_logic').html(div_contents_make_anti_phrase);
  		}
	});


	$('#exampleModal2').on('show.bs.modal', function (event) {
  		var button = $(event.relatedTarget) // Button that triggered the modal
  		var trId = button.attr("id")
  		var bull_id = "bullet" + trId.split('_')[2];
  		var corr_bull = $('#' + bull_id).text();
  		var corr_bull1 = jQuery.trim(corr_bull);
  		console.log(corr_bull1);
		$("#pos_phrase_category_button").attr("name", trId.split('_')[2]);
		$("#pos_phrase_data_panel_button").attr("name", trId.split('_')[2]);
		$("#pos_phrase_category_bullet_input").val(corr_bull1);
		$("#pos_phrase_datapanel_bullet_input").val(corr_bull1);
	});


	$('#exampleModal3').on('show.bs.modal', function (event) {
  		var button = $(event.relatedTarget) // Button that triggered the modal
  		var trId = button.attr("id")
  		var trReq = document.getElementById(trId)
  		var id_back = trId.split('_')[1] + "_" + trId.split('_')[2] + "_" + trId.split('_')[3];
  		var col0 = trReq.getElementsByClassName("sub_ele_td_source")[0]
  		var col1 = trReq.getElementsByClassName("sub_ele_td_components")[0]
  		var col2 = trReq.getElementsByClassName("sub_ele_td_hs")[0]
  		var col3 = trReq.getElementsByClassName("sub_ele_td_ss")[0]
  		var col4 = trReq.getElementsByClassName("sub_ele_td_comp")[0]
  		var compo_lis = col1.getElementsByTagName("td")
  		var comp_lis = col4.getElementsByTagName("td")
  		var hs_lis = col2.getElementsByTagName("td")
  		var ss_lis = col3.getElementsByTagName("td")
		var modal = $(this)
		console.log(comp_lis[0].textContent)
		modal.find('.modal-body').html('<div>Not allowed in this case</div>')
		if (col0.textContent.split('_')[2] == "soft"){
			if (hs_lis.length == 0 && ss_lis.length ==1){
				modal.find('.modal-title').text('Make Anti-VN_SOFT');
				div_contents = "<div class=\"container\"><div class=\"row\"><div class=\"col-md-4\"><div>Verb</div><hr><div>" + compo_lis[1].textContent + "</div></div><div class=\"col-md-4\"><div>Enter Noun</div><hr><div><input type=\"text\" class=\"form-control\" id=\"anti_vn_soft_skills_noun_input\"></div></div><div class=\"col-md-4\"><div>Competency</div><hr><div><a>" + comp_lis[0].textContent + "</a></div></div></div></div><div style=\"padding-top:15px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"anti_vn_soft_skills_button\" name=\"" + id_back + "\">ADD</button></div>";
				modal.find('.modal-body').html(div_contents);
			}
		}
		if (col0.textContent.split('_')[2] == "hard"){
			if (hs_lis.length == 1 && ss_lis.length ==0){
				modal.find('.modal-title').text('Make Anti-VN_HARD');
				div_contents = "<div class=\"container\"><div class=\"row\"><div class=\"col-md-4\"><div>Verb</div><hr><div>" + compo_lis[1].textContent + "</div></div><div class=\"col-md-4\"><div>Enter Noun</div><hr><div><input type=\"text\" class=\"form-control\" id=\"anti_vn_hard_skills_noun_input\"></div></div><div class=\"col-md-4\"><div>HARD-SKILL</div><hr><div><a>" + hs_lis[0].textContent + "</a></div></div></div></div><div style=\"padding-top:15px\"><button type=\"button\" class=\"btn btn-secondary\" id=\"anti_vn_hard_skills_button\" name=\"" + id_back + "\">ADD</button></div>";
				modal.find('.modal-body').html(div_contents);
			}
		}
	});

	$("#remove_hs").delegate("#modal_remove_hs_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		console.log(tr_id);
		var req_tr = $(document.getElementById(tr_id))
		req_tr.addClass("error to_remove_hs")
		// var tr_class = req_tr.attr("class")
		// console.log(tr_class)
	});

	$("#remove_ss").delegate("#modal_remove_ss_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		console.log(tr_id);
		var req_tr = $(document.getElementById(tr_id))
		req_tr.addClass("error to_remove_ss")
	});

	$("#remove_hs_ss").delegate("#modal_remove_hs_ss_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		console.log(tr_id);
		var req_tr = $(document.getElementById(tr_id))
		var req_td_hs = $(document.getElementById(tr_id).getElementsByClassName("sub_ele_td_hs")[0])
		var req_td_ss = $(document.getElementById(tr_id).getElementsByClassName("sub_ele_td_ss")[0])
		req_tr.addClass("to_remove_hs_ss")
		req_td_hs.addClass("error")
		req_td_ss.addClass("error")
	});

	$(" #add_ss").delegate("#modal_add_ss_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		var trReq = document.getElementById(tr_id)
  		var col0 = trReq.getElementsByClassName("sub_ele_td_source")[0]
  		var col1 = trReq.getElementsByClassName("sub_ele_td_components")[0]
		var values = $('#ss_add_select option:selected').val();
		console.log(values);
		var req_table_id = "try_table_" + but_name.split('_')[0] + '_' + but_name.split('_')[1]
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		req_tableBody.innerHTML += "<tr class=\"ele_sub_table to_add_ss success\"><td class=\"sub_ele_td_source\">" + col0.innerHTML + "</td><td class=\"sub_ele_td_components\">" + col1.innerHTML + "</td><td class=\"sub_ele_td_hs\"><div><a></a></div></td><td class=\"sub_ele_td_ss\"><div><table class=\"table\"><tr><td>" + values + "</td></tr></table></div></td><td class=\"sub_ele_td_comp\"><div><a></a></div></td></tr>"
		// var but_name = $(this).attr("name");
		// var tr_id = "subMyInput_" + but_name
	});

	$("#add_hs").delegate("#modal_add_hs_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		var trReq = document.getElementById(tr_id)
  		var col0 = trReq.getElementsByClassName("sub_ele_td_source")[0]
  		var col1 = trReq.getElementsByClassName("sub_ele_td_components")[0]
  		// console.log(col1.innerHTML)
		var bla = $('#add_hs_input').val();
		console.log(bla)
		var req_table_id = "try_table_" + but_name.split('_')[0] + '_' + but_name.split('_')[1]
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		req_tableBody.innerHTML += "<tr class=\"ele_sub_table to_add_hs success\"><td class=\"sub_ele_td_source\">" + col0.innerHTML + "</td><td class=\"sub_ele_td_components\">" + col1.innerHTML + "</td><td class=\"sub_ele_td_hs\"><div><table class=\"table\"><tr><td>" + bla + "</td></tr></table></div></td><td class=\"sub_ele_td_ss\"><div><a></a></div></td><td class=\"sub_ele_td_comp\"><div><a></a></div></td></tr>"
		// console.log(req_tableBody.innerHTML);
	});

	$("#make_anti_phrase_vn").delegate("#make_anti_phrase_vn_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name.split("_")[0] + '_' + but_name.split("_")[1] + '_' + but_name.split("_")[2]
		var trReq = document.getElementById(tr_id)
  		var col = trReq.getElementsByClassName("sub_ele_td_ss")[0]
  		if (but_name.split("_")[3] == "hs"){
  			col = trReq.getElementsByClassName("sub_ele_td_hs")[0]
  		}
		var bla = $('#anti_phrase_bullet_description').val();
		console.log(bla)
		var req_table_id = "try_table_" + but_name.split('_')[0]
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		var make_anti_phrase_tr = "<tr class=\"ele_sub_table to_make_anti_phrase success\"><td class=\"sub_ele_td_source\">logic::anti_phrase_vn</td><td class=\"sub_ele_td_components\">" + bla + "</td><td class=\"sub_ele_td_hs\">" + col.innerHTML + "</td><td class=\"sub_ele_td_ss\"><div><a></a></div></td><td class=\"sub_ele_td_comp\"><div><a></a></div></td></tr>"
		if (but_name.split("_")[3] == "ss"){
			make_anti_phrase_tr = "<tr class=\"ele_sub_table to_add_anti_phrase_vn success\"><td class=\"sub_ele_td_source\">logic::anti_phrase_vn</td><td class=\"sub_ele_td_components\">" + bla + "</td><td class=\"sub_ele_td_hs\"><div><a></a></div></td><td class=\"sub_ele_td_ss\">" + col.innerHTML + "</td><td class=\"sub_ele_td_comp\"><div><a></a></div></td></tr>"
		}
		req_tableBody.innerHTML += make_anti_phrase_tr
		alert("Anti-Phrase added in table")
		// console.log(req_tableBody.innerHTML);
	});


	$("#remove_comp").delegate("#modal1_remove_comp_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		console.log(tr_id);
		var req_tr = $(document.getElementById(tr_id))
		req_tr.addClass("error to_remove_comp")
	});


	$("#add_comp").delegate("#modal1_add_comp_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		var trReq = document.getElementById(tr_id)
  		var col0 = trReq.getElementsByClassName("sub_ele_td_source")[0]
  		var col1 = trReq.getElementsByClassName("sub_ele_td_components")[0]
  		var tr_keyword = col1.getElementsByTagName("tr")[1]
		var values = $('#comp_add_select option:selected').val();
		console.log(values);
		var req_comp = "";
		$.each(useful_array, function(ke_cate, val_comp) { 
    		if(val_comp[0] == values) {
    			req_comp = val_comp[1];
        		return false; 
    		}
		});
		console.log(req_comp)
		var req_table_id = "try_table_" + but_name.split('_')[0] + '_' + but_name.split('_')[1]
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		req_tableBody.innerHTML += "<tr class=\"ele_sub_table to_add_comp success\"><td class=\"sub_ele_td_source\">" + col0.innerHTML + "</td><td class=\"sub_ele_td_components\"><div><table class=\"table\"><tr><td><span style=\"font-weight:bold\">category</span></td><td>" + values + "</td></tr><tr>" + tr_keyword.innerHTML +"</tr></table></div></td><td class=\"sub_ele_td_hs\"><div><a></a></div></td><td class=\"sub_ele_td_ss\"><div><a></a></div></td><td class=\"sub_ele_td_comp\"><div><table class=\"table\"><tr><td>" + req_comp + "</td></tr></table></div></td></tr>"
		// var but_name = $(this).attr("name");
		// var tr_id = "subMyInput_" + but_name
	});


	$("#make_anti_phrase_logic").delegate("#make_anti_phrase_category_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name.split("_")[0] + '_' + but_name.split("_")[1] + '_' + but_name.split("_")[2]
		var trReq = document.getElementById(tr_id)
  		var col = trReq.getElementsByClassName("sub_ele_td_comp")[0]
		var bla = $('#anti_phrase_category_bullet_description').val();
		console.log(bla)
		var req_table_id = "try_table_" + but_name.split('_')[0]
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		var make_anti_phrase_tr = "<tr class=\"ele to_make_anti_phrase_category success\"><td class=\"ele_td_verb\">logic::anti_phrase_category</td><td class=\"ele_td_noun\">" + bla + "</td><td class=\"ele_td_hs\"><div><a></a></div></td><td class=\"ele_td_ss\"><div><a></a></div></td><td class=\"ele_td_comp\">" + col.innerHTML + "</td></tr>";
		req_tableBody.innerHTML += make_anti_phrase_tr
		alert("Anti-Phrase_category added in table")
		// console.log(req_tableBody.innerHTML);
	});


	$("#add_comp").delegate("#modal1_add_comp_button_data_panel", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		var trReq = document.getElementById(tr_id)
  		var col0 = trReq.getElementsByClassName("sub_ele_td_source")[0]
  		var col1 = trReq.getElementsByClassName("sub_ele_td_components")[0]
		var values = $('#comp_add_select_data_panel').val();
		console.log(values);
		var req_table_id = "try_table_" + but_name.split('_')[0] + '_' + but_name.split('_')[1]
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		var tr_html = "<tr class=\"ele_sub_table to_add_comp_data_panel success\"><td class=\"sub_ele_td_source\">" + col0.innerHTML + "</td><td class=\"sub_ele_td_components\">" + col1.innerHTML + "</td><td class=\"sub_ele_td_hs\"><div><a></a></div></td><td class=\"sub_ele_td_ss\"><div><a></a></div></td><td class=\"sub_ele_td_comp\"><div><table class=\"table\">";
		$.each(values, function(ke_comp_dp, val_comp_dp) { 
    		var te_comp = "<tr><td>" + val_comp_dp + "</td></tr>";
    		tr_html += te_comp;
		});
		tr_html += "</table></div></td></tr>"
		req_tableBody.innerHTML += tr_html;
		// var but_name = $(this).attr("name");
		// var tr_id = "subMyInput_" + but_name
	});

	$("#remove_comp").delegate("#modal1_remove_comp_button_data_panel", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		// console.log(tr_id);
		var req_tr = document.getElementById(tr_id);
		$(document.getElementById(tr_id)).addClass("to_remove_comp_data_panel");
		var col1 = req_tr.getElementsByClassName("sub_ele_td_comp")[0]
		var all_comp_lis = col1.getElementsByTagName("td");
		var all_comp_arr = [];
		$.each(all_comp_lis, function(ke_td_dp, val_td_dp) { 
			var te_comp = val_td_dp.innerText;
			all_comp_arr.push(te_comp);
		});
		console.log(all_comp_arr)
		var values = $('#comp_remove_select_data_panel').val();
		console.log(values);
		console.log(jQuery.inArray(values[0], all_comp_arr))
		$.each(values, function(ke_comp_dp, val_comp_dp) {
    		$(document.getElementById(tr_id).getElementsByClassName("sub_ele_td_comp")[0].getElementsByTagName("td")[jQuery.inArray(val_comp_dp, all_comp_arr)]).addClass("error to_remove_comp_td_data_panel")
		});
	});


	$("#make_anti_phrase_logic").delegate("#make_anti_phrase_data_panel_button", "click", function() {
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		var trReq = document.getElementById(tr_id)
  		var bla = $('#anti_phrase_data_panel_bullet_description').val();
		var values = $('#comp_antiphrase_select_data_panel').val();
		console.log(values);
		var req_table_id = "try_table_" + but_name.split('_')[0]
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		var make_anti_phrase_tr = "<tr class=\"ele to_make_anti_phrase_data_panel success\"><td class=\"ele_td_verb\">logic::anti_phrase_data_panel</td><td class=\"ele_td_noun\">" + bla + "</td><td class=\"ele_td_hs\"><div><a></a></div></td><td class=\"ele_td_ss\"><div><a></a></div></td><td class=\"ele_td_comp\"><div><table class=\"table\">";
		$.each(values, function(ke_comp_dp, val_comp_dp) { 
    		var te_comp = "<tr><td>" + val_comp_dp + "</td></tr>";
    		make_anti_phrase_tr += te_comp;
		});
		make_anti_phrase_tr += "</table></div></td></tr>"
		req_tableBody.innerHTML += make_anti_phrase_tr
		alert("Anti-Phrase_dataPanel added in table")
		// var but_name = $(this).attr("name");
		// var tr_id = "subMyInput_" + but_name
	});

	$("#pos_phrase_category_button").click(function() {
		var but_name = $(this).attr("name");
		var values = $('#pos_phrase_select_category option:selected').val();
		console.log(values);
		var req_comp = "";
		$.each(useful_array, function(ke_comp, val_comp) { 
    		if(val_comp[0] == values) {
    			req_comp = val_comp[1];
        		return false; 
    		}
		});
		var bla = $('#pos_phrase_category_bullet_input').val();
		console.log(bla)
		console.log(req_comp)
		var req_table_id = "try_table_" + but_name
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		req_tableBody.innerHTML += "<tr class=\"ele to_add_positive_phrase_category success\"><td class=\"ele_td_verb\">logic::positive_phrase_category</td><td class=\"ele_td_noun\"><div><table class=\"table\"><tr><td><span style=\"font-weight:bold\">category</span></td><td>" + values + "</td></tr><tr><td><span style=\"font-weight:bold\">keyword</span></td><td>" + bla + "</td></tr></table></div></td><td class=\"ele_td_hs\"><div><a></a></div></td><td class=\"ele_td_ss\"><div><a></a></div></td><td class=\"ele_td_comp\"><div><table class=\"table\"><tr><td>" + req_comp + "</td></tr></table></div></td></tr>"
		// var but_name = $(this).attr("name");
		// var tr_id = "subMyInput_" + but_name
	});

	$("#pos_phrase_data_panel_button").click(function() {
		var but_name = $(this).attr("name");
		var cat_value = $('#pos_phrase_select_data_panel option:selected').val();
		console.log(cat_value);
		var comp_values = $('#pos_phrase_select_comp_data_panel').val();
		console.log(comp_values)
		var bla = $('#pos_phrase_datapanel_bullet_input').val();
		console.log(bla)
		var req_table_id = "try_table_" + but_name
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		var tr_content = "<tr class=\"ele to_add_positive_phrase_datapanel success\"><td class=\"ele_td_verb\">logic::positive_phrase_datapanel</td><td class=\"ele_td_noun\"><div><table class=\"table\"><tr><td><span style=\"font-weight:bold\">category</span></td><td>" + cat_value + "</td></tr><tr><td><span style=\"font-weight:bold\">keyword</span></td><td>" + bla + "</td></tr></table></div></td><td class=\"ele_td_hs\"><div><a></a></div></td><td class=\"ele_td_ss\"><div><a></a></div></td><td class=\"ele_td_comp\"><div><table class=\"table\">";
		$.each(comp_values, function(ke_comp, val_comp) {
			var comp_te = "<tr><td>" + val_comp + "</td></tr>";
			tr_content += comp_te;
		});
		tr_content += "</table></div></td></tr>"
		req_tableBody.innerHTML += tr_content;
		// var but_name = $(this).attr("name");
		// var tr_id = "subMyInput_" + but_name
	});

	$("#exampleModal3").delegate("#anti_vn_soft_skills_button", "click", function(){
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		var trReq = document.getElementById(tr_id)
  		var col4 = trReq.getElementsByClassName("sub_ele_td_comp")[0]
  		var col1 = trReq.getElementsByClassName("sub_ele_td_components")[0]
  		var compo_lis = col1.getElementsByTagName("td")
		var values = $('#anti_vn_soft_skills_noun_input').val();
		console.log(values);
		var req_table_id = "try_table_" + but_name.split('_')[0] + '_' + but_name.split('_')[1]
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		var tr_html = "<tr class=\"ele_sub_table to_make_anti_vn_soft error\"><td class=\"sub_ele_td_source\">logic::anti_vn_soft</td><td class=\"sub_ele_td_components\"><div><table class=\"table\"><tr><td><span style=\"font-weight:bold\">verb</span></td><td>" + compo_lis[1].textContent + "</td></tr><tr><td><span style=\"font-weight:bold\">noun</span></td><td>" + values + "</td></tr></table></div></td><td class=\"sub_ele_td_hs\"><div><a></a></div></td><td class=\"sub_ele_td_ss\"><div><a></a></div></td><td class=\"sub_ele_td_comp\">" + col4.innerHTML + "</td></tr>";
		req_tableBody.innerHTML += tr_html;
	});


	$("#exampleModal3").delegate("#anti_vn_hard_skills_button", "click", function(){
		var but_name = $(this).attr("name");
		var tr_id = "subMyInput_" + but_name
		var trReq = document.getElementById(tr_id)
  		var col2 = trReq.getElementsByClassName("sub_ele_td_hs")[0]
  		var col1 = trReq.getElementsByClassName("sub_ele_td_components")[0]
  		var compo_lis = col1.getElementsByTagName("td")
		var values = $('#anti_vn_soft_skills_noun_input').val();
		console.log(values);
		var req_table_id = "try_table_" + but_name.split('_')[0] + '_' + but_name.split('_')[1]
		var req_table = document.getElementById(req_table_id)
		var req_tableBody = req_table.getElementsByTagName("tbody")[0]
		var tr_html = "<tr class=\"ele_sub_table to_make_anti_vn_hard error\"><td class=\"sub_ele_td_source\">logic::anti_vn_hard</td><td class=\"sub_ele_td_components\"><div><table class=\"table\"><tr><td><span style=\"font-weight:bold\">verb</span></td><td>" + compo_lis[1].textContent + "</td></tr><tr><td><span style=\"font-weight:bold\">noun</span></td><td>" + values + "</td></tr></table></div></td><td class=\"sub_ele_td_hs\">" + col2.innerHTML + "</td><td class=\"sub_ele_td_ss\"><div><a></a></div></td><td class=\"sub_ele_td_comp\"><div><a></a></div></td></tr>";
		req_tableBody.innerHTML += tr_html;
	});





	$( 'input' ).keyup(function (e) {
		var inputId = $(e.target).attr("id");
		if (inputId.split('_')[0] == "myInput"){
			var input = document.getElementById(inputId);
			filter = input.value.toUpperCase();
			var element = inputId.split('_')[2];
			var col_type = inputId.split('_')[1];
			console.log(col_type);
			var table_id = "try_table_".concat(element);
			table = document.getElementById(table_id);
			tr = table.getElementsByClassName("ele");
			console.log(tr.length);
			// td = tr[0].getElementsByClassName("ele_td_noun");
			// console.log(td.length);
	    	if (col_type == "verb"){
	    		for (i = 0; i < tr.length; i++) {
	    			t = tr[i].getElementsByClassName("ele_td_verb")[0];
	    			if (t) {
		      			if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
		        			tr[i].style.display = "";
		      			} else {
		        			tr[i].style.display = "none";
		      			}
		    		}
	    		}
	    	}
	    	else if (col_type == "noun"){
	    		for (i = 0; i < tr.length; i++) {
		    		t = tr[i].getElementsByClassName("ele_td_noun")[0];
		    		if (t) {
			      		if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        		tr[i].style.display = "";
			      		} else {
			        		tr[i].style.display = "none";
			      		}
			    	}
	    		}
	    	}
	    	else if (col_type =="hs"){
	    		for (i = 0; i < tr.length; i++) {
		    		t = tr[i].getElementsByClassName("ele_td_hs")[0];
		    		if (t) {
			      		if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        		tr[i].style.display = "";
			      		} else {
			        		tr[i].style.display = "none";
			      		}
			    	}
			    }
	    	}
	    	else if (col_type =="ss"){
	    		for (i = 0; i < tr.length; i++) {
		    		t = tr[i].getElementsByClassName("ele_td_ss")[0];
		    		if (t) {
			      		if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        		tr[i].style.display = "";
			      		} else {
			        		tr[i].style.display = "none";
			      		}
			    	}
			    }
	    	}
	    	else{
	    		for (i = 0; i < tr.length; i++) {
		    		t= tr[i].getElementsByClassName("ele_td_comp")[0];
		    		if (t) {
			      		if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        		tr[i].style.display = "";
			      		} else {
			        		tr[i].style.display = "none";
			      		}
			    	}
			    }
	    	}
		}
		else if(inputId.split('_')[0] == "bullet"){
			var input = document.getElementById(inputId);
			filter = input.value.toUpperCase();
			console.log(col_type);
			cards = document.getElementsByClassName("card");
			console.log(cards.length);
			for (i = 0; i < cards.length; i++) {
				bullet_des = cards[i].getElementsByClassName("bullet_search_class_div")[0];
				if(bullet_des){
					if (bullet_des.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        	cards[i].style.display = "";
			      	}else {
			        	cards[i].style.display = "none";
			      	}
				}
			}
		}
		else if (inputId.split('_')[0] == "comp") {
			var input = document.getElementById(inputId);
			filter = input.value.toUpperCase();
			console.log(col_type);
			cards = document.getElementsByClassName("card");
			console.log(cards.length);
			for (i = 0; i < cards.length; i++) {
				comp_des = cards[i].getElementsByClassName("comp_search_class_div")[0];
				if(comp_des){
					if (comp_des.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        	cards[i].style.display = "";
			      	}else {
			        	cards[i].style.display = "none";
			      	}
				}
			}
		}
		else if (inputId.split('_')[0] == "subMyInput"){
			var input = document.getElementById(inputId);
			filter = input.value.toUpperCase();
			var element1 = inputId.split('_')[3];
			var element = inputId.split('_')[2];
			var col_type = inputId.split('_')[1];
			console.log(col_type);
			var table_id = (("try_table_".concat(element)).concat('_')).concat(element1);
			console.log(table_id);
			table = document.getElementById(table_id);
			tr = table.getElementsByClassName("ele_sub_table");
			console.log(tr.length);
			// td = tr[0].getElementsByClassName("ele_td_noun");
			// console.log(td.length);
	    	if (col_type == "source"){
	    		for (i = 0; i < tr.length; i++) {
	    			t = tr[i].getElementsByClassName("sub_ele_td_source")[0];
	    			if (t) {
		      			if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
		        			tr[i].style.display = "";
		      			} else {
		        			tr[i].style.display = "none";
		      			}
		    		}
	    		}
	    	}
	    	else if (col_type == "components"){
	    		for (i = 0; i < tr.length; i++) {
		    		t = tr[i].getElementsByClassName("sub_ele_td_components")[0];
		    		if (t) {
			      		if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        		tr[i].style.display = "";
			      		} else {
			        		tr[i].style.display = "none";
			      		}
			    	}
	    		}
	    	}
	    	else if (col_type =="hs"){
	    		for (i = 0; i < tr.length; i++) {
		    		t = tr[i].getElementsByClassName("sub_ele_td_hs")[0];
		    		if (t) {
			      		if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        		tr[i].style.display = "";
			      		} else {
			        		tr[i].style.display = "none";
			      		}
			    	}
			    }
	    	}
	    	else if (col_type =="ss"){
	    		for (i = 0; i < tr.length; i++) {
		    		t = tr[i].getElementsByClassName("sub_ele_td_ss")[0];
		    		if (t) {
			      		if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        		tr[i].style.display = "";
			      		} else {
			        		tr[i].style.display = "none";
			      		}
			    	}
			    }
	    	}
	    	else{
	    		for (i = 0; i < tr.length; i++) {
		    		t= tr[i].getElementsByClassName("sub_ele_td_comp")[0];
		    		if (t) {
			      		if (t.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        		tr[i].style.display = "";
			      		} else {
			        		tr[i].style.display = "none";
			      		}
			    	}
			    }
	    	}
		}
		else{

		}
	});
});


</script>
@endsection