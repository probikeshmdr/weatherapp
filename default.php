<?php
/**
 * Created by PhpStorm.
 * User: Ranjan Dahal
 * Date: 11/23/17
 * Time: 7:49 PM
 */
include 'view/header.php'; ?>

    <script>
        $(document).ready(function () {

            function clearData() {
                $('#weather6').text('');
                $('#weather12').text('');
                $('#darksky6').text('');
                $('#darksky12').text('');
                $('#accu6').text('');
                $('#accu12').text('');
                $('#nooa6').text('');
                $('#nooa12').text('');
                $('#loc').text('');
            }

            function setUI(data) {
                //$('#accu6').text(data);
                var i = 0, j = 0;
                try {
                    var day_or_night = '';
                    var json_content = JSON.parse(data);
                    for (i = 0; i < json_content.length; i++) {
                        if (json_content[i].length > 0) {
                            var block = '';
                            var block6 = '';
                            var inner_json_content = json_content[i];
                            for (j = 0; j < inner_json_content.length; j++) {
                                var hour = inner_json_content[j]['hour'];
                                var hour_only = parseInt((inner_json_content[j]['hour']).substring(0, 2));
                                if(j == 0)
                                    block += '<div id="current" class="alert alert-info';
                                else if(j%2 == 1)
                                    block += '<div id="odd" class="alert alert-success';
                                else
                                    block += '<div id="even" class="alert alert-warning';

                                if(inner_json_content[j]['isdaytime'] == '1'){
                                    day_or_night = 'wi wi-day';
                                    block += ' day"><div class="text-center hour">As of <span>'
                                        + hour + '</span></div>';
                                }else{
                                    day_or_night = 'wi wi-night';
                                    block += ' night"><div class="text-center hour">As of <span>'
                                        + hour + '</span></div>';
                                }

                                block += '<div class="temp-phreas"> <div class="text-left temp"><i class="' + day_or_night + '"><h3>'
                                         + inner_json_content[j]['temp'] + '&deg;F</h3></i></div>';
                                block += '<div class="text-left icon-phrase"><i class="' + day_or_night + '"><h4>'
                                         + inner_json_content[j]['icon_phrase'] + '</h4></i></div></div>';
                                block += '<div class="text-right icon-box">' +
                                         '<img src="' + inner_json_content[j]['icon'] /*icons/sunny.png*/ +
                                         '" class="img-fluid" style="margin-left: -20px" alt="' +
                                         inner_json_content[j]['icon_phrase'] + '"/> </div>';
                                block += '<div class="text-left">Feels like <i class="' + day_or_night + '"><h4>'
                                         + inner_json_content[j]['real_feel_temp'] + '&deg;F</h4></i></div>';

                                //block += '<p>' + inner_json_content[j]['isdaytime'] + '</p>';
                                block += '<i class="' + day_or_night + '-windy">'
                                         + inner_json_content[j]['wind_speed']
                                         + '</i>';
                                block += '<i class="wi wi-humidity">'
                                         + inner_json_content[j]['humidity']
                                         + '</i>';
                                block += '<i class="' + day_or_night + '-cloudy">'
                                         + inner_json_content[j]['cloud_cover']
                                         + '</i>';
                                block += '<i class="wi wi-rain">'
                                         + inner_json_content[j]['rain_probability']
                                         + '</i>';
                                block += '<i class="' + day_or_night + '-snow">'
                                         + inner_json_content[j]['snow_probability']
                                         + '</i>';
                                block += '</div>';
                                if(i == 0 && j == 2)
                                    block6 = block;
                                else if(j == 6)
                                    block6 = block;
                            }
                            if (i == 0) {
                                $('#weather6').append(block6);
                                $('#weather12').append(block);
                            }else if (i == 1) {
                                $('#darksky6').append(block6);
                                $('#darksky12').append(block);
                            }else if (i == 2) {
                                $('#accu6').append(block6);
                                $('#accu12').append(block);
                            }else{
                                $('#nooa6').append(block6);
                                $('#nooa12').append(block);
                            }
                        }
                    }
                }catch(err) {
                    if (i == 0) {
                        $('#weather6').append(err.message);
                        $('#weather12').append(err.message);
                    }else if(i == 1) {
                        $('#darksky6').append(err.message);
                        $('#darksky12').append(err.message);
                    }else if(i == 2) {
                        $('#accu6').append(err.message);
                        $('#accu12').append(err.message);
                    }else if(i == 3) {
                        $('#nooa6').append(err.message);
                        $('#nooa12').append(err.message);
                    }
                }
            }

            var weather_data = '<?php print_r($weather_data); ?>';
            setUI(weather_data);
            $('#loc').append('<?php echo $loc_key['localname'] . ', ' . $loc_key['state'] . ' ' . $loc_key['postal']; ?>');

            var cities = "";
            $.ajax(
                {
                    url : 'model/cities.php',
                    type: "GET",
                    success:function(data, textStatus, jqXHR)
                    {
                        //data: return data from server
                        //$('#accu6').text(data);
                        cities = data.split(';');
                        $( "#search" ).autocomplete({
                            source: cities
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        //if fails
                    }
                });

            $("#searchform").submit(function(e)
            {
                // Show full page LoadingOverlay
                $.LoadingOverlay("show");

                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");
                $.ajax(
                    {
                        url : formURL,
                        type: "GET",
                        data : postData,
                        success:function(data, textStatus, jqXHR)
                        {
                            clearData();
                            //data: return data from server
                            var loc_key = data.substr(0, data.indexOf("["));
                            data = data.substr(data.indexOf("["));
                            setUI(data);

                            var json_loc = JSON.parse(loc_key);

                            $('#loc').append(json_loc['localname'] + ', ' + json_loc['state'] + ' ' + json_loc['postal']);

                            // Hide it after ajax call completion
                            $.LoadingOverlay("hide");
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            //if fails
                        }
                    });
                e.preventDefault(); //STOP default action
            });

            $('#searchsubmit').click(function () {
                $("#searchform").submit(); //Submit  the FORM
            });
            $('#search').keypress(function(e){
                if(e.keyCode==13)
                    $('#searchsubmit').click();
            });
        })
    </script>
    <div class="container">
        <div class="text-center" style="padding-top: 8px;">
            <button class="btn btn-primary" type="button">
                <span class="badge" id="loc" style="font-size:x-large;"></span>
            </button>
        </div>
        <hr>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">6 Hours</a></li>
            <li><a data-toggle="tab" href="#option1">12 Hours</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-sm-3">
                        <h3 class="text-center">OpenWeather</h3>
                        <div id="weather6">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="text-center">Dark Sky</h3>
                        <div id="darksky6">

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="text-center">AccuWeather</h3>
                        <div id="accu6">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="text-center">NOAA</h3>
                        <div id="nooa6">
                        </div>
                    </div>
                </div>
            </div>
            <div id="option1" class="tab-pane fade">
                <div class="row">
                    <div class="col-sm-3">
                        <h3 class="text-center">OpenWeather</h3>
                        <div id="weather12">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="text-center">Dark Sky</h3>
                        <div id="darksky12">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="text-center">AccuWeather</h3>
                        <div id="accu12">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="text-center">NOAA</h3>
                        <div id="nooa12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'view/footer.php';