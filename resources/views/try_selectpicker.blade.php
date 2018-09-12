<html>  
<head>  
    <title>jQuery bootstrap-select</title>  
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script> 
    <script type="text/javascript" src="http://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/js/bootstrap-select.js"></script>    
    <link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/css/bootstrap-select.css">    
    
  
  
    <!-- 3.0 -->  
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">  
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>  
  
    <!-- 2.3.2  
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">  
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.js"></script>  
    -->  
    <script type="text/javascript">  
        $(window).on('load', function () {  
  
            $('.selectpicker').selectpicker({  
                'selectedText': 'cat'  
            });  
  
            // $('.selectpicker').selectpicker('hide');  
        });  
    </script>  
</head>  
<body>  
<div class="col-lg-10">
    <label for="id_select">Test label YEag</label>  
    <select id="id_select" class="selectpicker bla bla bli" data-live-search="true">  
        <option>cow</option>  
        <option>bull</option>  
        <option class="get-class" disabled>ox</option>  
        <optgroup label="test" data-subtext="another test" data-icon="icon-ok">  
            <option>ASD</option>  
            <option selected>Bla</option>  
            <option>Ble</option>  
        </optgroup>  
    </select>  
</div> 

    <div class="container">  
        <form class="form-horizontal" role="form">  
            <div class="form-group">  
                <label for="bs3Select" class="col-lg-2 control-label">Test bootstrap 3 form(multiple select)</label>  
                <div class="col-lg-10">  
                    <select id="bs3Select" class="selectpicker show-tick form-control" multiple data-live-search="true">  
                        <option>cow</option>  
                        <option>bull</option>  
                        <option class="get-class" disabled>ox</option>  
                        <optgroup label="test" data-subtext="another test" data-icon="icon-ok">  
                            <option>ASD</option>  
                            <option selected>Bla</option>  
                            <option>Ble</option>  
                        </optgroup>  
                    </select>  
                </div>  
              </div>  
        <form>  
    </div>  
  
</body>  
</html>  