@extends('layouts.app')

@section('home')
    <span id="home_id"></span>
@endsection

@section('content')
<div class="modal fade bs-example-modal-md" id="edit_row" tabindex="-1" role="dialog" style="width:100%" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Edit Row</h5>
            </div>

            <form id="edit_row_form">
            <div class="modal-body">
                <div style="text-align: center;" class="form-group" id="editJDMain">
                    <div class="col-md-3" style="display: inline-block;">
                    <label class="control-label" for="editJDtitleInput">JD Title</label>
                    <input type="text" id="editJDtitleInput" class="form-control" name="editJDtitleName">
                    </div>
                    <div class="col-md-3" style="display: inline-block;">
                    <label class="control-label" for="editJDFunctionInput">JD Function</label></br>
                    <select id="editJDFunctionInput"  name="editJDFunction">
                        @foreach ($tag_list['jd_function_list'] as $jd_function)
                            <option value="{{$jd_function}}">{{ucwords(str_replace("_"," ",$jd_function))}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-3" style="display: inline-block;">
                    <label class="control-label" for="editJDIndustryInput">JD Industry</label></br>
                    <select id="editJDIndustryInput"  name="editJDind" multiple="multiple">
                        @foreach ($tag_list['jd_industry_list'] as $jd_industry)
                            <option value="{{$jd_industry}}">{{ucwords(str_replace("_"," ",$jd_industry))}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-3" style="display: inline-block;">
                    <label class="control-label" for="editJDlevelInput">Title Level</label></br>
                    <select id="editJDlevelInput"  name="editJDlevel">
                        @foreach ($tag_list['title_level_list'] as $title_level)
                            <option value="{{$title_level}}">{{ucwords(str_replace("_"," ",$title_level))}}</option>
                        @endforeach
                    </select>
                    </div>

                
                

                </div>
            </div>

            <div class="modal-footer" style="text-align: center;">
                <input id="editJDmodalButton" class="btn btn-success" type="submit" value="Update Row"  style="margin-top: 10px;">
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-md" id="showJD" tabindex="-1" role="dialog" style="width:100%" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;JD Text</h5>
            </div>

            <div class="modal-body">
                <div class="row form-group" style="text-align:center;">
                    <div class="col-md-3">
                    <label class="control-label" for="job_title">Job Title</label>
                    <div id="job_title"></div>
                    </div>
                    <div class="col-md-3">
                    <label class="control-label" for="com_name">Company</label>
                    <div id="com_name"></div>
                    </div>
                    <div class="col-md-3">
                    <label class="control-label" for="jd_function">JD Function</label>
                    <div id="jd_function">Function 1</div>
                    </div>
                    <div class="col-md-3">
                    <label class="control-label" for="jd_industry">JD Industry</label>
                    <div id="jd_industry">Industry 1</div>
                    </div>
                </div>
                <label class="control-label" for="showtext">JD Text</label>
                <div id="showtext">
                </div>
            </div>
<!--             <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-success" id="addJDmodalButton" onclick="submitJDtext()" style="font-size: 13px; min-width: 120px;">Add JD</button>
            </div> -->
        </div>
    </div>
</div>



<div class="container" style="width:100%">
    <div class="row">
        <div class="col-md-12">
            
            <form class="form-horizontal" id="csv_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="col-md-6" style="display: inline:block;">
                            <div class="col-md-8"> 
                                <label for="community">Select Community</label>
                                <select name="community" id="community" multiple="multiple" style="width: 170px; margin-left: 6px; height: 30px;" required="required">
                                    @foreach ($tag_list['community_list'] as $community)
                                        <option value="{{$community}}">{{ucfirst($community)}}</option>
                                    @endforeach
                                </select>
                                <input id="get_data" style="margin-left:20px;" class="btn btn-success" type="button" value="Get Data" onclick="get_community_data()">
                            </div>
                            <div class = "col-md-4">
                                <input id="addCommunity" class="btn btn-success" type="button" value="Add New Community" onclick="add_community_popup(event)">
                            </div>
                        </div>
                        <div class="col-md-6" id="upload_div">
                            <div class="col-md-8" style="display: inline:block;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label style="display: inline:block;" for="file_uploaded">Upload <b>File</b></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" id="file_uploaded" name="file_uploaded" accept=".csv" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" style="display: inline:block;">
                                <input id="uploadButton" class="btn btn-success" type="submit" value="Upload file">
                                <!-- <button type="submit">Upload</button> -->
                            </div>
                        </div>
                    </div>
                </form>
                
                <div class="col-md-12 row" id = "header_div" style="display:none">
                    <div class="col-md-6" style="display: inline-block;">
                        <table class="file_header table table-hover table-bordered" id = "file_headers">
                            <thead style = "background-color: #f8f8f8;">
                                <th class="col-md-8">File Title Name</th>
                                <th class="col-md-4">Col number</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6" style="display: inline-block;">
                        <table class="original_header table table-hover table-bordered">
                            <thead style = "background-color: #f8f8f8;">
                                <th class="col-md-8">Vmock Title Name</th>
                                <th class="col-md-4">Col number</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        <button id="submit_title" disabled onclick="submit_form(event)">Submit</button>
                    </div>
                </div>


                
                <div class="col-md-12 row" id = "csv_output_data" style="display:none">

                    <div class="col-md-12" style="display: inline-block;">
                        <div class="table-responsive">
                            <table class="output_table table table-hover table-bordered" id="output_table_id">
                                <thead style = "background-color: #f8f8f8;">
                                    <th >JD ID</th>
                                    <th> Community</th>
                                    <th >JD Title</th>
                                    <th>Company</th>
                                    <th >JD Function</th>
                                    <th >JD Industry</th>
                                    <th >Title Level</th>
                                    <th >ES JDs</th>
                                    <th >End State</th>
                                    <th>Done</th>

                                </thead>
                                <tbody style="word-break: break-word;">
                                    
                                </tbody>
                            </table>
                        </div>
                        <form id="table_form" action="{{url('/es_cluster')}}" method="POST" enctype="multipart/form-data" style="display: inline-block;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="community_name_2" id="community_name_2" value="">
                            <button type="button" id="submit_table_button" onclick="submit_table(event)">Go To Clustering</button>
                        </form>
                        <div style="display: inline-block;">
                            <button type="submit" id="report">Generate Report</button>
                        </div>
                        <div style="display: inline-block;" class="download-btn-container">
                        </div>

                    </div>
                </div>


        </div>
    </div>
</div>
<script type="text/javascript">
var current_jd_id = 0;
var current_expand_row = 0;
var jd_out_data;
var no_of_col;
var new_community_data = {};
var selected_community;
var expand_row_info = {};
var es_structure;
var jd_text_info = {};
var current_es;
var community_list = <?php echo json_encode($tag_list["community_list"])?>;
var all_end_state_list = <?php echo json_encode($es_list) ?>;

var data_table = $('#output_table_id').DataTable(
    {"columns": [
        { "data": "Auto_ID" },
        {"data" : "community"},
        { "data": "job_title" },
        { "data": "company_name" },
        { "data": "jd_function" },
        { "data": "jd_industry" },
        { "data": "title_level" },
        {"data": "es_jds"},
        { "data": "end_state_list" },
        { "data": "done"}]});


function add_community_popup(event){
    event.preventDefault();
    var new_community = prompt("Please enter new community name:", "");
    console.log(new_community);
    new_community = new_community.toLowerCase();
    if ((new_community != null) && (new_community != '')){

        console.log(new_community);
        if(confirm("You want to add new community '"+new_community+"'") ==  true){

            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
                });
            $.ajax({
                url: '{{url('add_community')}}',
                type: 'POST',
                data: {'new_community':new_community},

                success: function (data) {
                    console.log(data);
                    community_list = data.community_list;
                    optgroups = community_data(community_list);
                    $('#community').multiselect("dataprovider",optgroups);
                    $('#community').multiselect("refresh");
                    makeAlertBox("success| new community added successfully");
                },
                complete: function(data) {

                },

                error: function (request, status, error) {
                    makeAlertBox('error| '+request.responseJSON.status);
                }

            });
            
            console.log("you pressed ok");
        }
        else{
            console.log("you pressed cancel");
        }
    }else{
        alert("Community name can't be empty");
    }
    

}


function submit_table(event){
    event.preventDefault();
    $('#community_name_2').val(JSON.stringify(selected_community));
    console.log(JSON.stringify(selected_community));
    $('#table_form').submit();
}


function get_community_data(){
    console.log("you selected "+$("#community").val());
    selected_community = $("#community").val();
    if (selected_community == null){
        makeAlertBox("error| Please select desired community first.");
    }else{
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });
        $.ajax({
            url: '{{url('get_community_data')}}',
            beforeSend: function() { $(".loader").fadeOut("slow"); },
            complete: function() { $(".loader").hide(); },
            type: 'POST',
            data: {'selected_community':selected_community},
            success: function (data) {
                if (data.status == true){
                    $('#header_div').hide();
                    $('#csv_output_data').show();
                    $('#csv_output_data').css('margin-top','20px');
                    get_csv_div(data.community_data);
                    es_structure = data.es_structure;
                    data_table.draw();
                }else if (data.status == false){
                    $('#community_name_2').val(JSON.stringify(selected_community));
                    $('#table_form').submit();

                }
                

            },

            complete: function(data) {

            },
            error: function (request, status, error) {
                makeAlertBox('info| '+request.responseJSON.status);
                $('#csv_output_data').hide();
            }
        });
    }

}

$("#report").click(function (e) {
    e.preventDefault();
    community_name = selected_community[0];
    console.log(community_name);
    $('.download-btn').fadeOut('fast');
    $.get('{{url('download_report')}}', {community: community_name, task:'gap'}, function(result) {
        console.log(result);
        var button = '<a href='+result+'><button type="submit" class="download-btn" id="report">Donwload Report</button></a>'
        $('.download-btn-container').html(button);
    })

});

$("#jd_text_form").submit(function(event){
        
        event.preventDefault();
    
        var formData = new FormData(this);
        formData.append('key',current_jd_id);
        formData.append('selected_community',selected_community);

        $('#addJD').modal('hide');
        $("#addJDtitleInput").val("");
        $("#addJDCompanyInput").val("");
        $("#jd_upload").val("");
        $("#addJDtext").val("");
        $("#header_present").val("");
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });
        $.ajax({
            url: '{{url('upload_jd')}}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                updated_row = data.output;
                new_expand_row_info = data.expand_row_output;
                console.log(new_expand_row_info);
            },
            complete: function(data) {
                jd_out_data[current_jd_id] = updated_row[current_jd_id];
                new_html = create_new_row(updated_row[current_jd_id]);
                data_table.row('#'+current_jd_id).data(new_html).draw(false);

            }
        });

        return false;
    });



function open_modal(event,button_id){
    current_jd_id = button_id;
    current_jd_detail = jd_out_data[current_jd_id];
    $("#addJDtitleInput").val(current_jd_detail['job_title']);
    $('#addJDFunctionInput').multiselect({enableFiltering: true,maxHeight: 450 });
    $('#addJDIndustryInput').multiselect({enableFiltering: true,maxHeight: 450 });
    $('#addJDFunctionInput').val(current_jd_detail['jd_function']);
    $('#addJDFunctionInput').multiselect("refresh");
    $('#addJDIndustryInput').val(current_jd_detail['jd_industry']);
    $('#addJDIndustryInput').multiselect("refresh");
    company_details = JSON.parse(current_jd_detail['company_name']);
    if (company_details.length == 1){
        $("#addJDCompanyInput").val(company_details[0]);
    }else{
        $("#addJDCompanyInput").val("");
    }
    $('#addJD').modal('show');
}

function show_jd(event,row_id){


    row_id_array = row_id.split("_");
    jd_id = row_id_array.pop();
    row_id = row_id_array.pop();
    row_community = row_id_array.join("_");
    if(!(jd_id in jd_text_info)){
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });
        $.ajax({
            url: '{{url('get_jd_text')}}',
            type: 'POST',
            data: {'selected_community':row_community, 'jd_unique_key':jd_id},
            success: function (data) {
                jd_text_info[jd_id] = data.jd_text
                jd_info = jd_text_info[jd_id];
                jd_text = jd_info['jd_text'];
                jd_company = jd_info['company_name'];
                jd_title = jd_info['job_title'];
                jd_function = jd_info['jd_function'];
                jd_industry = jd_info['jd_industry'];
                document.getElementById("showtext").innerHTML = '<pre style="white-space: pre-wrap; word-break: break-word;">'+jd_text+'</pre>';
                document.getElementById("com_name").innerHTML = jd_company;
                document.getElementById("job_title").innerHTML = jd_title;
                document.getElementById("jd_function").innerHTML = jd_function;
                document.getElementById("jd_industry").innerHTML = jd_industry;
                $('#showJD').modal('show');

            },
            complete: function(data) {

            }
        });
    }else{
        jd_info = jd_text_info[jd_id];
        jd_text = jd_info['jd_text'];
        jd_company = jd_info['company_name'];
        jd_title = jd_info['job_title'];
        jd_function = jd_info['jd_function'];
        jd_industry = jd_info['jd_industry'];
        document.getElementById("showtext").innerHTML = '<pre style="white-space: pre-wrap; word-break: break-word;">'+jd_text+'</pre>';
        document.getElementById("com_name").innerHTML = jd_company;
        document.getElementById("job_title").innerHTML = jd_title;
        document.getElementById("jd_function").innerHTML = jd_function;
        document.getElementById("jd_industry").innerHTML = jd_industry;
        $('#showJD').modal('show');

    }

}

function show_es_jd(event,jd_id) {

    jd_text_info = expand_row_info[current_es][jd_id];
    jd_text = jd_text_info['jd_text'];
    jd_company = jd_text_info['company_name'];
    jd_title = jd_text_info['job_title'];
    jd_function = jd_text_info['jd_function'];
    jd_industry = jd_text_info['jd_industry'];
    document.getElementById("showtext").innerHTML = '<pre style="white-space: pre-wrap; word-break: break-word;">'+jd_text+'</pre>';
    document.getElementById("com_name").innerHTML = jd_company;
    document.getElementById("job_title").innerHTML = jd_title;
    document.getElementById("jd_function").innerHTML = jd_function;
    document.getElementById("jd_industry").innerHTML = jd_industry;
    $('#showJD').modal('show');
}

function delete_jd(event,k){
    
    event = event || window.event;
    event = event.target || event.srcElement;
    delete_id = event.id;
    delete_row_id = delete_id.split("__")[0];

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
        });
    $.ajax({
        url: '{{url('delete_jd')}}',
        type: 'POST',
        data: {'selected_community':selected_community, 'key':delete_row_id,'delete_jd_id':k},
        success: function (data) {
            updated_row = data.updated_row;
        },
        complete: function(data) {

            jd_out_data[delete_row_id] = updated_row[delete_row_id];
            new_html = create_new_row(updated_row[delete_row_id]);
            data_table.row('#'+delete_row_id).data(new_html).draw(false);
            updated_child = {};
            no_of_jd = updated_row[delete_row_id]['match_count'];
            match_jd_info = JSON.parse(updated_row[delete_row_id]['match_jd_info'])
            for (var i = 0; i < match_jd_info.length; i++){
                key = match_jd_info[i];
                updated_child[key]= expand_row_info[key];
            }
            expand_row_info = updated_child;
            data_table.row('#'+delete_row_id).child(format_details(expand_row_info,delete_row_id)).show();

            if (data_table.row('#'+delete_row_id).child.isShown()) {
                $('#row_details_'+delete_row_id).removeClass().addClass("glyphicon glyphicon-minus minus-red");
            }
            if (no_of_jd == 0){
                data_table.row('#'+delete_row_id).child().hide();
            }
        }
    });




}


function split_row(event,com_id){


    row_id_array = com_id.split("_");

    c = row_id_array.pop();
    key = row_id_array.join("_");
    row_id = row_id_array.pop();
    row_community = row_id_array.join("_");

    com_no = parseInt(c);
    key_details = jd_out_data[key];

    // jd_id = key_details[col_no][com_no][1];
    new_com_name = JSON.parse(key_details['company_name'])[com_no];
    if (new_com_name[1] == row_id){
        com_list = JSON.parse(key_details['company_name'])
        com_list.splice(com_no,1);
        new_company_list = com_list;
    }else{
        new_company_list = [new_com_name];
    }
    new_com_list = new_company_list.map(function(value,index) { return value[1]; });
    console.log(new_com_list);
    if(confirm("Do you want to separate this company '"+new_com_name[0]+"'") ==  true){


        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });
        $.ajax({
            url: '{{url('split_row')}}',
            type: 'POST',
            data: {'selected_community':row_community, 'key':row_id,'split_company':new_com_list},
            success: function (data) {
                old_row = data.old_row;
                new_row = data.new_row;
                new_key = new_row['Auto_ID'];
                jd_out_data[new_key] = new_row;
                jd_out_data[old_row['Auto_ID']] = old_row;
                old_row_html = create_new_row(old_row);
                new_row_html = create_new_row(new_row);
                data_table.row('#'+key).data(old_row_html);
                data_table.row.add(new_row_html).draw(false);
                var msg_old = new_key+" has been created. \n"+key+" has been updated.";
                makeAlertBox("info| "+msg_old);
            },
            complete: function(data) {


            }
        });

    }

    

}

function format_details(row_data,row_id){
    var table_html = '<table cellpadding="5" class="table table-hover table-bordered" style="width:100%; border-color: #7f7878; border-width: 5px"><thead><th class="col-md-2" style="background-color: #a3ecba;">JD ID</th><th class="col-md-2" style="background-color: #a3ecba;">JD Title</th><th class="col-md-2" style="background-color: #a3ecba;">Company</th><th class="col-md-2" style="background-color: #a3ecba;">JD Function</th><th class="col-md-2" style="background-color: #a3ecba;">JD Industry</th><th class="col-md-2" style="background-color: #a3ecba;">View JD</th></thead>';
    
    for (var key in row_data){
        row = row_data[key];
        table_html += '<tr><td>'+row['id_given']+'</td><td>'+row['job_title']+'</td><td>'+row['company_name']+'</td><td>'+row['jd_function']+'</td><td>'+row['jd_industry']+'</td>';

        name = row['id_given'];
        button_id = row_id+"__"+name;
        table_html += '<td><button id="'+button_id+'" onclick="show_es_jd(event,\''+name+'\')">Show JD</button></td>';
        table_html += '</tr>';
    }

    return table_html;



}


function show_details(event,row_id){

    previous_row = data_table.row('#'+current_expand_row)
    if ((previous_row.child.isShown()) && (current_expand_row != row_id)){
        previous_row.child.hide();
        $('#row_details_'+current_expand_row).removeClass().addClass("glyphicon glyphicon-plus plus-green");
    }
    current_expand_row = row_id;

    row = data_table.row('#'+row_id);
    row_data = JSON.parse(jd_out_data[row_id]['match_jd_info']);
    if ( row.child.isShown() ) {
            row.child.hide();
            $('#row_details_'+row_id).removeClass().addClass("glyphicon glyphicon-plus plus-green");

        }
    else {

        // if (!(row_id in expand_row_info)){
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });
        $.ajax({
            url: '{{url('expand_row_info')}}',
            type: 'POST',
            data: {'expand_row_ids':row_data},
            success: function (data) {
                console.log("expand_row_info",expand_row_info);
                console.log("data output",data.output);
                expand_row_info = data.output;
            },
            complete: function(data) {

                row.child(format_details(expand_row_info,row_id)).show();
                $('#row_details_'+row_id).removeClass().addClass("glyphicon glyphicon-minus minus-red");

            }
        });
        // }else{

        //     row.child(format_details(expand_row_info,row_id)).show();
        //     $('#row_details_'+row_id).removeClass().addClass("glyphicon glyphicon-minus minus-red");

        // }
        


            

    }
}

function submit_row(event,row_id){

    // if(confirm("Do you want to submit this row!") ==  true){
    if (1){

        end_state_radio = $('input:radio[name=radio_'+row_id+']:checked','#form_'+row_id).val();
        more_end_state = $('#end_state_list_'+row_id).val();
        if(end_state_radio){
            end_state_final = end_state_radio;
        }else if(more_end_state){
            end_state_final = more_end_state;
        }
        curr_row_company_info = JSON.parse(jd_out_data[row_id]['company_name']);
        key_list = curr_row_company_info.map(function(value,index) { return value[1]; });

        row_id_array = row_id.split("_");
        row_id_db = row_id_array.pop();
        row_community = row_id_array.join("_");

        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });
        $.ajax({
            url: '{{url('submit_row')}}',
            type: 'POST',
            data: {'selected_community':row_community,'row_id':JSON.stringify(key_list),'end_state_final':end_state_final},
            success: function (data) {
                console.log(data.status);
                delete jd_out_data[row_id];
                data_table.row('#'+row_id).remove().draw(false);
                makeAlertBox('success| '+data.status);
            },
            complete: function(data) {

                
            }
        });

    }
    else{
        console.log("you pressed cancel");
    }

}

function delete_row(event,row_id){

    if(confirm("Do you want to delete this row!") ==  true){

        curr_row_company_info = JSON.parse(jd_out_data[row_id]['company_name']);
        key_list = curr_row_company_info.map(function(value,index) { return value[1]; });

        row_id_array = row_id.split("_");
        row_id_db = row_id_array.pop();
        row_community = row_id_array.join("_");
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });
        $.ajax({
            url: '{{url('delete_row')}}',
            type: 'POST',
            data: {'selected_community':row_community,'row_id':JSON.stringify(key_list)},
            success: function (data) {
                delete jd_out_data[row_id];
                data_table.row('#'+row_id).remove().draw(false);
                makeAlertBox('success| '+data.status);
            },
            complete: function(data) {

                
            }
        });

    }
    else{
        console.log("you pressed cancel");
    }

}



function edit_row(event,row_id){
    current_jd_id = row_id;
    current_jd_detail = jd_out_data[current_jd_id];
    current_jd_ind_list = JSON.parse(current_jd_detail['jd_industry']);
    $("#editJDtitleInput").val(current_jd_detail['job_title']);
    $('#editJDFunctionInput').multiselect({enableFiltering: true,maxHeight: 450,enableCaseInsensitiveFiltering: true});
    $('#editJDIndustryInput').multiselect({enableFiltering: true,maxHeight: 450,enableCaseInsensitiveFiltering: true});
    $('#editJDlevelInput').multiselect({enableFiltering: true,maxHeight: 450,enableCaseInsensitiveFiltering: true});
    $('#editJDFunctionInput').val(current_jd_detail['jd_function']);
    $('#editJDFunctionInput').multiselect("refresh");
    $('#editJDIndustryInput').val(current_jd_ind_list);
    $('#editJDIndustryInput').multiselect("refresh");
    $('#editJDlevelInput').val(current_jd_detail['title_level']);
    $('#editJDlevelInput').multiselect("refresh");
    $('#edit_row').modal('show');
}


$("#edit_row_form").submit(function(event){
        
    event.preventDefault();

    row_array = current_jd_id.split("_");
    row_array.pop();
    row_community = row_array.join("_");
    var formData = new FormData(this);
    curr_row_company_info = JSON.parse(jd_out_data[current_jd_id]['company_name']);
    key_list = curr_row_company_info.map(function(value,index) { return value[1]; });
    match_id_list = curr_row_company_info.map(function(value,index) { return value[2]; });
    formData.append('key_list',JSON.stringify(key_list));
    formData.append('selected_community',row_community);
    formData.append('match_id_list',JSON.stringify(match_id_list));

    new_ind_list = $("#editJDIndustryInput").val();

    formData.append('new_industry_list',JSON.stringify(new_ind_list));

    $('#edit_row').modal('hide');
    $("#editJDtitleInput").val("");
    $("#editJDFunctionInput").val("");
    $("#editJDIndustryInput").val("");
    $("#editJDlevelInput").val("");
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
        });
    $.ajax({
        url: '{{url('edit_row')}}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            updated_row = data.updated_row;
            console.log(updated_row);
            if (!$.isEmptyObject(updated_row)){
                console.log("updated_row exist");
                jd_out_data[current_jd_id] = updated_row;
                new_html = create_new_row(updated_row);
                data_table.row('#'+current_jd_id).data(new_html).draw(false);
            }else{
                console.log("updated_row not exist");
                delete jd_out_data[current_jd_id];
                data_table.row('#'+current_jd_id).remove().draw(false);
                makeAlertBox("info| updated row does not matches to existing end states.")
            }
            jd_text_info = {};
        },
        complete: function(data) {
            
        }
    });

    return false;
});



function create_new_row(row){

    var data_table_string = {};
    row_details = '';
    row_id = row['Auto_ID'];
    data_table_string['DT_RowId'] = row_id;
    for (var key in row){

        if (key == "Auto_ID"){

            auto_id_array = row[key].split("_");
            autoID = auto_id_array.pop();
            community = auto_id_array.join("_");
            data_table_string[key] = autoID+'<span id="row_edit_'+row_id+'" class="glyphicon glyphicon-pencil" onclick="edit_row(event,\''+row_id+'\')" style="margin-left:5px; color:blue;"></span>';
            data_table_string["community"] = community;
            
        }else if (key == "company_name"){
            company_info = JSON.parse(row[key]);
            if (company_info.length > 1){
                var new_cell = '';
                for (var c=0; c < company_info.length;c++){
                    com_id = row_id.toString()+"_"+c.toString();
                    new_cell +=  company_info[c][0];
                    if (company_info[c][2]){
                        jd_unique_key = company_info[c][2]
                        file_icon = '<span id="show_jd_'+row_id+'" class="glyphicon glyphicon-file" onclick="show_jd(event,\''+row_id+"_"+jd_unique_key+'\')" style="margin-left:5px; font-size:17px;"></span>';
                        new_cell += file_icon;
                    }
                    
                    delete_icon = '<span class="glyphicon glyphicon-remove-circle" style="margin-left:5px; font-size:18px;" onclick="split_row(event,\''+com_id+'\')"></span></br>';

                    new_cell += delete_icon;
                }
                data_table_string[key] = new_cell;
            }else{
                 new_cell = company_info[0][0];
                if (company_info[0][2]){
                    jd_unique_key = company_info[0][2]
                    file_icon = '<span id="show_jd_'+row_id+'" class="glyphicon glyphicon-file" onclick="show_jd(event,\''+row_id+"_"+jd_unique_key+'\')" style="margin-left:5px; font-size:17px;"></span>';
                    new_cell += file_icon;
                }
                data_table_string[key] = new_cell;
            }

        }else if (key == "end_state_list"){
            end_state_list = JSON.parse(row[key]);
            es_string = '<form id="form_'+row_id+'">';
            es_string += '<fieldset id="radio_'+row_id+'">';
            radio_checked = false;
            for (var e = 0; e < end_state_list.length; e++){
                es = end_state_list[e]
                if (!radio_checked){
                    es_string += '<label class="radio-inline es_radio" style="margin-left:0px;"><input type="radio" onClick="uncheck_list(event,\''+row_id+'\')" name="radio_'+row_id+'" value="'+es+'" checked>'+es.replace(/_/gi, " ")+'</label></br>';
                    radio_checked = true;
                }else{
                    es_string += '<label class="radio-inline es_radio" style="margin-left:0px;"><input type="radio" onClick="uncheck_list(event,\''+row_id+'\')" name="radio_'+row_id+'" value="'+es+'">'+es.replace(/_/gi, " ")+'</label></br>';
                }

            }

            es_string += '<label class="radio-inline es_radio" style="margin-left:0px;"><input type="radio" onClick="uncheck_list(event,\''+row_id+'\')" name="radio_'+row_id+'" value="new_end_state">new end state</label></br>';
              
            es_string += '</fieldset>'     
            es_string += '<select id="end_state_list_'+row_id+'" name="end_state_list_'+row_id+'" onClick="get_related_es(event,\''+row_id+'\')" onchange="uncheck_radio(event,\''+row_id+'\')"><option selected disabled hidden value="">More End States</option></select>';
            es_string += '</form>';

            data_table_string[key] = es_string;

        }else if (key == "jd_industry"){
            industry_list = JSON.parse(row[key]);
            data_table_string[key] = industry_list.join(",, ");
        }else{
            data_table_string[key] = row[key];
        }
        // add_jd = '<button id="'+row_id+'" onclick="open_modal(event,\''+row_id+'\')">View JD</button>';
        // data_table_string['jd_text'] = add_jd;
        es_jds_html = '<span id="es_jds_'+row_id+'" class="glyphicon glyphicon-cloud-download plus-green" onclick="get_es_jds(event,\''+row_id+'\')" style="margin-left:5px; font-size:20px;"></span>';

        data_table_string['es_jds'] = es_jds_html;

        data_table_string['done'] = '<span id="done_'+row_id+'" class="glyphicon glyphicon-ok-sign" onclick="submit_row(event,\''+row_id+'\')" style="margin-left:5px; font-size:20px; color:green;"></span><span id="remove_'+row_id+'" class="glyphicon glyphicon-remove-sign" onclick="delete_row(event,\''+row_id+'\')" style="margin-left:5px; font-size:20px; color:red;"></span>';
    }
    return data_table_string;

}


function get_es_jds(event,row_id) {
    
    row = data_table.row('#'+row_id);

    if ( row.child.isShown() ) {
            row.child.hide();
            $('#es_jds_'+row_id).removeClass().addClass("glyphicon glyphicon-cloud-download plus-green");
        }
    else {

        end_state_radio = $('input:radio[name=radio_'+row_id+']:checked','#form_'+row_id).val();
        more_end_state = $('#end_state_list_'+row_id).val();
        if(end_state_radio){
            end_state_final = end_state_radio;
        }else if(more_end_state){
            end_state_final = more_end_state;
        }

        current_es = end_state_final;
        console.log(end_state_final);

        if(!(end_state_final in expand_row_info)){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
                });
            $.ajax({
                url: '{{url('get_es_jds')}}',
                type: 'POST',
                data: {'end_state_final':end_state_final},
                success: function (data) {
                    if(Object.keys(data.es_jd_data).length > 0){
                        expand_row_info[end_state_final] = data.es_jd_data;
                        row.child(format_details(expand_row_info[end_state_final],row_id)).show();
                        $('#es_jds_'+row_id).removeClass().addClass("glyphicon glyphicon-cloud-upload minus-red");
                    }else{
                        makeAlertBox("error| No JD available for this End State.");
                    }

                },
                complete: function(data) {

                }
            });
        }else{
            row.child(format_details(expand_row_info[end_state_final],row_id)).show();
            $('#es_jds_'+row_id).removeClass().addClass("glyphicon glyphicon-cloud-upload minus-red");
        }
        
            
    }

    

    
}


function get_csv_div(result_output){
    var data_table_string = '';
    jd_out_data = result_output;
    data_table.clear();

    for (var key in jd_out_data){
        data_table.row.add(create_new_row(jd_out_data[key]));
    }
}

function get_endstate_list(jd_function,jd_industry_list,title_level){

    es_list = [];
    if (jd_industry_list.length == 0){
        industry = "no_industry";
    }else{
        for (var ind in jd_industry_list){
            industry = jd_industry_list[ind];
            if (jd_function in es_structure['es_structure']){
                if (industry in es_structure['es_structure'][jd_function]){
                    if (title_level in es_structure['es_structure'][jd_function][industry]){
                        $.merge(es_list,es_structure['es_structure'][jd_function][industry][title_level]);
                    }
                }else if ('no_industry' in es_structure['es_structure'][jd_function]){
                    if (title_level in es_structure['es_structure'][jd_function]['no_industry']){
                        $.merge(es_list,es_structure['es_structure'][jd_function]['no_industry'][title_level]);
                    }
                }
            }
        }
    }
    es_list = $.unique(es_list);
    return es_list;
}

function find_related_endstate(jd_function,jd_industry_list,title_level) {
    related_endstate_list = {};
    console.log(jd_function,jd_industry_list,title_level);

    console.log(es_structure['es_structure']);
    related_function_list = $.unique([].concat.apply([],[es_structure['related_function_dict'][jd_function],[jd_function]])).sort();
    for (var fun in related_function_list){
        rel_fun = related_function_list[fun];
        console.log(rel_fun);
        function_endstate_list = get_endstate_list(rel_fun,jd_industry_list, title_level)
        // if (rel_fun == jd_function){
        //     category = 'actual_function'
        // }else{
        //     category = 'related_function'
        // }
        if (function_endstate_list.length > 0){
            related_endstate_list[rel_fun] = function_endstate_list;
        }
        // $.merge(related_endstate_list,function_endstate_list);
        // for (var es in function_endstate_list){
        //     related_endstate_list.push([function_endstate_list[es], rel_fun, category])
        // }

    }
    // related_endstate_list = $.unique(related_endstate_list);
    
    console.log("related_endstate_list ",related_endstate_list);
    return related_endstate_list;
}


function get_related_es(event,row_id) {
    jd_info = jd_out_data[row_id];
    related_es = find_related_endstate(jd_info['jd_function'],JSON.parse(jd_info['jd_industry']),jd_info['title_level'].toLowerCase().split(" ").join("_"));
    $('#end_state_list_'+row_id).multiselect({enableFiltering: true,maxHeight: 450,enableCaseInsensitiveFiltering: true});

    $('#end_state_list_'+row_id).multiselect({
        noneSelectedText: 'More End States',
        onChange: function(element, row_id) {
            $('input[name=radio_'+row_id+']').attr('checked',false);
        }
    });
    var optgroups = [];

    existing_end_state_list = JSON.parse(jd_out_data[row_id]["end_state_list"])
    optgroups.push({label: "More End States",value:""});

    var suggested_es = [];
    optgroups.push({label:"Suggested End State", children: suggested_es});

    for (var fun in related_es){
        childern_array = []
        for (var es in related_es[fun]){
            if ($.inArray(related_es[fun][es],existing_end_state_list) == -1){
                childern_array.push({label : all_end_state_list[fun][related_es[fun][es]]["endstate_name"], value: related_es[fun][es]});
            }
        }
        if (childern_array.length > 0){
            optgroups.push({label: fun, children:childern_array})

        }
    }


    var all_es = []
    optgroups.push({label:"All End State", children: all_es});
    for (var fun in all_end_state_list){
        childern_array = []
        for (var es in all_end_state_list[fun]){
            es_value = all_end_state_list[fun][es]["id"];
            if ($.inArray(es_value,related_es[fun]) == -1){
                childern_array.push({label : all_end_state_list[fun][es]["endstate_name"], value: es_value});
            }
        }
        optgroups.push({label: fun, children:childern_array})
    }


    $('#end_state_list_'+row_id).multiselect("dataprovider",optgroups);
    $('#end_state_list_'+row_id).multiselect("refresh");
}

function uncheck_radio(event,row_id){
    $('input[name=radio_'+row_id+']').attr('checked',false);
    row = data_table.row('#'+row_id);
    selected_es = $('#end_state_list_'+row_id).val();
    if (selected_es){
        if(selected_es != current_es && row.child.isShown()){
            current_es = selected_es;
            row.child.hide();
            $('#es_jds_'+row_id).removeClass().addClass("glyphicon glyphicon-cloud-download plus-green");
        }
    }
    
    
}

function uncheck_list(event,row_id){
    selected_es = $('input:radio[name=radio_'+row_id+']:checked','#form_'+row_id).val();
    row = data_table.row('#'+row_id);
    if(selected_es != current_es && row.child.isShown()){
        current_es = selected_es;
        row.child.hide();
        $('#es_jds_'+row_id).removeClass().addClass("glyphicon glyphicon-cloud-download plus-green");
    }
    if($('#end_state_list_'+row_id).val()){
        
        $('#end_state_list_'+row_id+' option:selected').each(function(element) {
           $(this).prop('selected', false);});
        $('#end_state_list_'+row_id).multiselect("refresh");
    }
}


function submit_form(event){
    event.preventDefault();
    selected_community = $('#community').val();
    
    if (selected_community.length == 1){

        $('#submit_title').attr('disabled',true);
        $('#uploadButton').attr('disabled',true);

        inputs = document.getElementsByClassName("input2");
        input_len = inputs.length;
        var manual_input_array = {};
        if (input_len > 0) {
            for(var i=0; i <input_len; i++)
                manual_input_array[inputs[i].name] = inputs[i].value;
            }
        // var required_fields = ['JOB_ROLE_TITLE','JD_FUNCTION','JD_INDUSTRY'];
        // for (var key in manual_input_array){

        //     if ((required_fields.indexOf(key) != -1) && (manual_input_array[key] == -1)){
        //         alert("File should contain all these columns : 'JOB_ROLE_TITLE','JD_FUNCTION','JD_INDUSTRY'");
        //         $('#submit_title').removeAttr('disabled');
        //         return false;
        //     }
        // }

        var required_fields = ['JOB_ROLE_TITLE','JD_TEXT'];
        for (var key in manual_input_array){

            if ((required_fields.indexOf(key) != -1) && (manual_input_array[key] == -1)){
                alert("File should contain all these columns : 'JOB_ROLE_TITLE','JD_TEXT'");
                $('#submit_title').removeAttr('disabled');
                return false;
            }
        }
        var function_flag = 0;
        if (manual_input_array['JD_FUNCTION'] != -1){
            function_flag = 1;
        }

        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });
        $.ajax({
            url: '{{url('upload_file')}}',
            type: 'POST',
            data: {'manual_input_array':manual_input_array,
                    'selected_community':selected_community[0],
                    'uploaded_file_path':uploaded_file_path,
                    'function_flag': function_flag,
                },
            success: function (data) {
                $('#header_div').hide();
                $('#csv_output_data').show();
                $('#csv_output_data').css('margin-top','20px');
                es_structure = data.es_structure;
                get_csv_div(data.output);

            },
            complete: function(data) {
                data_table.draw();
            }
        });
    }else{
        makeAlertBox("error| multiple Communities are selected.");
    }
    

}



function get_header_div(header_list, type, max_number = 0){
    var col_db_string = '';
    for (var i=0; i<header_list.length; i++){
        col_db_string += '<tr><td class="col-md-8">' + header_list[i] +'</td>';
        if (type == 'number'){
            name = header_list[i];
            col_db_string += '<td><select class="input2" name="'+name+'" id="'+name+'"><option value="-1" selected="selected">-1</option>';
            for (var k=0; k<max_number; k++){
                col_db_string += '<option value="'+k+'">'+k+'</option>';
            }
            col_db_string += '</select></td></tr>';
        }
        else{
            col_db_string += '<td class="col-md-4">'+i.toString() + '</td></tr>';
        }
    }
    return col_db_string;
}

$("#csv_form").submit(function(event){
        
        event.preventDefault();

        if ($('#community').val().length == 1){

            
            var buttonId = '#uploadButton';
            var buttonInitialText = $(buttonId).val();


            var file_info = document.getElementById('file_uploaded').files.length;
            if (!file_info){
                alert('Upload File');
                return false;
            }
       
            var formData = new FormData(this);

            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
                });
            $.ajax({
                url: '{{url('get_headers')}}',
                // xhr: function() {
                //    var xhr = new XMLHttpRequest();
                //    var total = 0;

                //    // Get the total size of files
                //    $.each(document.getElementById('file_uploaded').files, function(i, file) {
                //           total += file.size;
                //    });

                //    // Called when upload progress changes. xhr2
                //    xhr.upload.addEventListener("progress", function(evt) {
                //           var loaded = Math.round(((evt.loaded / total).toFixed(4))*10000)/100; // percent
                //           loaded = loaded > 100 ? 100 : loaded;
                //           $(buttonId).val('Uploading '+loaded +'%');
                //           // $('.progressLoader').html(loaded + '%' );
                //    }, false);

                // },

                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#csv_output_data').hide();
                    $('#header_div').show();
                    $('#header_div').css('margin-top','20px');
                    col_db_string = get_header_div(data.file_header, 'hidden')
                    $('.file_header').find('tbody').empty();
                    $('.file_header').find('tbody').append(col_db_string);

                    header_range = data.header_range;
                    col_db_string = get_header_div(data.vmock_header, 'number', header_range)
                    $('.original_header').find('tbody').empty();
                    $('.original_header').find('tbody').empty();

                    $('.original_header').find('tbody').append(col_db_string);
                    uploaded_file_path = data.filepath;
                },
                complete: function(data) {
                    $(buttonId).val(buttonInitialText);
                    $('#submit_title').removeAttr('disabled');
                    $('#file_headers').DataTable();
                    $('.input2').multiselect({enableFiltering: true});

                }
            });
            return false;

        }else{
            makeAlertBox("error| To upload community data Please selete only one community.");
        }

    });

function community_data(community_list) {
    var optgroups = [];
    for( var key in community_list){
        com_name = community_list[key];
        optgroups.push({label: com_name, title: com_name, value: com_name})
    }
    return optgroups;
}

$(document).ready(function() {
        optgroups = community_data(community_list);
        $('#community').multiselect();
        $('#community').multiselect('dataprovider',optgroups);
        $('#community').multiselect("refresh");
    });


</script>

@endsection