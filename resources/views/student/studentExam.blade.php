
@include('partials/header')
<!-- Compiled and minified CSS -->
<link rel="stylesheet" media="all" href="https://unpkg.com/materialize-stepper@3.1.0/dist/css/mstepper.min.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{asset('assets/css/studentExam.css')}}" />
<div class="page-loader"></div>

<div class="wrapper">

    <!-- ======================== Navigation ======================== -->
@include('partials/menu')

<!-- ========================  Tabsy wrapper ======================== -->

    <!-- ========================  Icons slider ======================== -->

    <section class="owl-icons-wrapper">

        <!-- === header === -->

        <header class="hidden">
            <h2>Pass exam</h2>
        </header>
        <?php
        if(isset($durationExam) && $durationExam !='00:00:00'){
        ?>
        <ul id="global" >
            <li><span class="days">00</span><p class="days_text">Days</p></li>
            <li class="seperator">:</li>
            <li><span class="hours">00</span><p class="hours_text">Hours</p></li>
            <li class="seperator">:</li>
            <li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
            <li class="seperator">:</li>
            <li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
        </ul>

    <?php } ?>
    </section>

    <!-- ========================  Block banner category ======================== -->

    <!-- ========================  Best seller ======================== -->

    <section class="contact section-questions">

        <!-- === Goolge map === -->

        <div id="map" style="background-image:url({{asset('assets/images/backgrounds/wall.jpg')}})"></div>

        <div class="container">


            <br>

            <button id="btn-start-recording" hidden>Start Recording</button>
            <button id="btn-stop-recording" hidden disabled>Stop Recording</button>

            <hr>
            <video controls autoplay playsinline hidden></video>

            <!--start section record screen-->
            <video class="video" width="600px" controls hidden></video>
            <button class="record-btn" id="btn-record-screen" hidden>record</button>

            <!--end screen-->
            <form id="msform" method="post" action="{{url('student/add-exam')}}">
                @csrf
                <input type="text" value="{{$idExam}}" name="idExam" class="form-control"  hidden>
                <input type="text" value="{{$idTeacher}}" name="idTeacher" class="form-control"  hidden>

                <input type="text" value="" name="video-url-input"  id="video-url-input" class="form-control video-url-input"  hidden>
                <input type="text" value="" name="screen-url-input"  id="screen-url-input" class="form-control screen-url-input"  hidden>

                <ul class="stepper horizontal " id="horizontal">

                    <?php foreach($listQuestionsSingleChoice as $question) { ?>
                    <li class="step step-to-shuffle step-{{$question->question_multi_choice_id}} draw">
                        <div class="step-title waves-effect waves-dark"></div>
                        <div class="step-content">
                            <div class="countdown" style="zoom:0.2;">
                                <svg viewBox="-50 -50 100 100" stroke-width="10">
                                    <circle r="45"></circle>
                                    <circle r="45" stroke-dasharray="282.7433388230814" stroke-dashoffset="282.7433388230814px"></circle>
                                </svg>
                            </div>
                            <?php if($durationExam=='00:00:00'){ ?>
                            <div class="countdown2" alt="<?php if($question->no_specific_time==true ){echo '10:00:00';}else{echo $question->duration;} ?>" style="text-align: center"></div>
                            <?php } ?>
                            <?php if($question->image !=null) {?>
                            <div style="margin-left:35%;">
                                <img alt="no image" src="{{asset('assets/uploads/'.$question->image)}}"  style="width:240px;"/>
                            </div>
                            <?php } ?>
                            <h5>{{$question->title}}</h5>
                            <label>Select the correct answer</label>
                            <div class="row">

                                <div class="col-md-6 com-xs-12">
                                    <div class="card red lighten-2  <?php if($question->is_single_choice==false) :?>card-options-multiple<?php else : ?>card-options <?php endif ;?>" id="step-{{$question->question_multi_choice_id}}" alt="{{$question->option_1}}" style="height: 90px;">
                                        <div class="card-content white-text card-4-options">
                                            <p><img src="{{asset('assets/images/square.png')}}" alt="Alternate Text" style="width:25px;margin-right:5%;" /> {{$question->option_1}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 com-xs-12">
                                    <div class="card blue-grey darken-1 <?php if($question->is_single_choice==false) :?>card-options-multiple<?php else : ?>card-options <?php endif ;?>" id="step-{{$question->question_multi_choice_id}}" alt="{{$question->option_2}}" style="height: 90px;">
                                        <div class="card-content white-text card-4-options">
                                            <p><img src="{{asset('assets/images/traingle.png')}}" alt="Alternate Text" style="width:25px;margin-right:5%;" />  {{$question->option_2}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 com-xs-12">
                                    <div class="card brown lighten-2  <?php if($question->is_single_choice==false) :?>card-options-multiple<?php else : ?>card-options <?php endif ;?>" id="step-{{$question->question_multi_choice_id}}" alt="{{$question->option_3}}" style="height: 90px;">
                                        <div class="card-content white-text card-4-options">
                                            <p><img src="{{asset('assets/images/cercle.png')}}" alt="Alternate Text" style="width:25px;margin-right:5%;" /> {{$question->option_3}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 com-xs-12">
                                    <div class="card  blue lighten-2 <?php if($question->is_single_choice==false) :?>card-options-multiple<?php else : ?>card-options <?php endif ;?>" id="step-{{$question->question_multi_choice_id}}" alt="{{$question->option_4}}" style="height: 90px;">
                                        <div class="card-content white-text card-4-options">
                                            <p><img src="{{asset('assets/images/xbox.png')}}" alt="Alternate Text" style="width:25px;margin-right:5%;" /> {{$question->option_4}}</p>
                                        </div>
                                    </div>
                                </div>
                                <?php if($question->option_5) :?>
                                <div class="col-md-6 com-xs-12">
                                    <div class="card teal accent-2 <?php if($question->is_single_choice==false) :?>card-options-multiple<?php else : ?>card-options <?php endif ;?>" id="step-{{$question->question_multi_choice_id}}" alt="{{$question->option_5}}" style="height: 90px;">
                                        <div class="card-content white-text card-4-options">
                                            <p><img src="{{asset('assets/images/xbox.png')}}" alt="Alternate Text" style="width:25px;margin-right:5%;" /> {{$question->option_5}}</p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif ?>
                                <?php if($question->option_6) : ?>
                                <div class="col-md-6 com-xs-12">
                                    <div class="card  blue-grey lighten-5 <?php if($question->is_single_choice==false) :?>card-options-multiple<?php else : ?>card-options <?php endif ;?>" id="step-{{$question->question_multi_choice_id}}" alt="{{$question->option_6}}" style="height: 90px;">
                                        <div class="card-content white-text card-4-options">
                                            <p><img src="{{asset('assets/images/xbox.png')}}" alt="Alternate Text" style="width:25px;margin-right:5%;" /> {{$question->option_6}}</p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif ?>


                                <div class="input-field col s12" >

                                    <select class="browser-default " name="select-options-cards-{{$question->question_multi_choice_id}}<?php if($question->is_single_choice==false) :?>[]<?php endif ?>" id="select-options-cards"  alt="{{$question->question_multi_choice_id}}" style="margin-top:7%;opacity:0;" <?php if($question->is_single_choice==false) :?>multiple<?php endif ?>>
                                        <option value=""  disabled selected>Choose the type of question</option>
                                        <option value="{{$question->option_1}}">{{$question->option_1}}</option>
                                        <option value="{{$question->option_2}}">{{$question->option_2}}</option>
                                        <option value="{{$question->option_3}}">{{$question->option_3}}</option>
                                        <option value="{{$question->option_4}}">{{$question->option_4}}</option>
                                        <option value="{{$question->option_5}}">{{$question->option_5}}</option>
                                        <option value="{{$question->option_6}}">{{$question->option_6}}</option>
                                    </select>

                                </div>
                            </div>

                            <p id="src-draw-me" hidden>{{$question->data_file}}</p>
                            <canvas width="600" height="400" id="draw-me"></canvas>
                            <canvas width="600" height="400" id="draw-new"></canvas>
                            <div class="controls">
                                <ul>
                                    <li class="red selected"></li>
                                    <li class="blue"></li>
                                    <li class="yellow"></li>
                                </ul>

                                <!--<button type="button" download="example.jpg" href=""  id="saveImage"  onclick="downloadCanvas(this);" hidden>Save Image</button>-->
                                <button type="button" id="revealColorSelect">New Color</button>
                                <div id="colorSelect">
                                    <span id="newColor"></span>
                                    <div class="sliders">
                                        <p>
                                            <label for="red">Red</label>
                                            <input id="red" name="red" type="range" min=0 max=255 value=0>
                                        </p>
                                        <p>
                                            <label for="green">Green</label>
                                            <input id="green" name="green" type="range" min=0 max=255 value=0>
                                        </p>
                                        <p>
                                            <label for="blue">Blue</label>
                                            <input id="blue" name="blue" type="range" min=0 max=255 value=0>
                                        </p>
                                    </div>
                                    <div>
                                        <button type="button" id="addNewColor">Add Color</button>
                                    </div>
                                </div>
                            </div>
                            <div class="step-actions">
                                <!--								<button class="waves-effect waves-dark btn blue next-step" data-feedback="someFunction">CONTINUE</button>
                                -->
                                <button class="waves-effect waves-dark btn blue next-step" >CONTINUE</button>
                                <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                    <?php foreach($listQuestionsLongText as $question) { ?>
                    <li class="step step-to-shuffle">
                        <div data-step-label="" class="step-title waves-effect waves-dark"></div>
                        <div class="step-content">
                            <div class="countdown" style="zoom:0.2;">
                                <svg viewBox="-50 -50 100 100" stroke-width="10">
                                    <circle r="45"></circle>
                                    <circle r="45" stroke-dasharray="282.7433388230814" stroke-dashoffset="282.7433388230814px"></circle>
                                </svg>
                            </div>
                            <?php if($durationExam=='00:00:00'){ ?>
                            <div class="countdown2" alt="<?php if($question->no_specific_time==true ){echo '10:00:00';}else{echo $question->duration;} ?>" style="text-align: center"></div>
                            <?php } ?>
                            <?php if($question->image !=null) {?>
                            <div style="margin-left:35%;">
                                <img alt="no image" src="{{asset('assets/uploads/'.$question->image)}}"  style="width:240px;"/>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="col-md-12" >
                                        <div class="form-group">
                                            <label style="text-align:left">{{$question->title}}</label>
                                            <input type="text" name="long-text-{{$question->question_long_text_id}}" class="form-control" placeholder="Your answer" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step-actions">
                                <button class="waves-effect waves-dark btn blue next-step">CONTINUE</button>
                            </div>
                        </div>
                    </li>
                    <?php } ?>

                    <?php foreach($listQuestionsTawsil as $question) { ?>
                    <li class="step step-to-shuffle">
                        <div class="step-title waves-effect waves-dark"></div>
                        <div class="step-content">
                            <div class="countdown" style="zoom:0.2;">
                                <svg viewBox="-50 -50 100 100" stroke-width="10">
                                    <circle r="45"></circle>
                                    <circle r="45" stroke-dasharray="282.7433388230814" stroke-dashoffset="282.7433388230814px"></circle>
                                </svg>
                            </div><?php if($durationExam=='00:00:00'){ ?>
                            <div class="countdown2" alt="<?php if($question->no_specific_time==true ){echo '10:00:00';}else{echo $question->duration;} ?>" style="text-align: center"></div>
                            <?php } ?>
                            <?php if($question->image !=null) {?>
                            <div style="margin-left:35%;">
                                <img alt="no image" src="{{asset('assets/uploads/'.$question->image)}}"  style="width:240px;"/>
                            </div>
                            <?php } ?>
                            <div class="row" >
                                <div class="input-field col s12">
                                    <label >Link the correct options</label>


                                    <div style="margin-top: 7%;">
                                        <div class="row">
                                            <img src="{{asset('assets/images/dragg.png')}}" alt="Alternate Text" style="width:35px;height: 35px;" />
                                            <img src="{{asset('assets/images/link.png')}}" alt="Alternate Text" style="width:25px;height: 35px;float:right;"/>
                                            <ul id="sortlist{{$question->question_tawsil_id}}" class="col-md-6 col-xs-6 sortlist" style="margin-top:30px;">
                                                <li alt="{{$question->option_1}}">

                                                    {{$question->option_1}}
                                                </li>
                                                <li alt="{{$question->option_2}}">
                                                    {{$question->option_2}}
                                                </li>
                                                <li alt="{{$question->option_3}}">
                                                    {{$question->option_3}}
                                                </li>
                                                <li alt="{{$question->option_4}}">
                                                    {{$question->option_4}}
                                                </li>
                                                <?php if(!empty($question->option_5)) :?>
                                                <li alt="{{$question->option_5}}">
                                                    {{$question->option_5}}

                                                </li>
                                                <?php endif;?>
                                                <?php if(!empty($question->option_6)) :?>
                                                <li alt="{{$question->option_6}}">
                                                    {{$question->option_6}}
                                                </li>
                                                <?php endif;?>
                                            </ul>

                                            <ul id="correspList"  class="correspList col-md-6 col-xs-6">
                                                <li>
                                                    {{$question->link_option_1}}
                                                </li>
                                                <li>{{$question->link_option_2}}</li>
                                                <li>{{$question->link_option_3}}</li>
                                                <li>{{$question->link_option_4}}</li>
                                                <?php if(!empty($question->link_option_5)) :?>
                                                <li>{{$question->link_option_5}}</li>
                                                <?php endif;?>
                                                <?php if(!empty($question->link_option_6)) :?>
                                                <li>{{$question->link_option_6}}</li>
                                                <?php endif;?>
                                            </ul>

                                            <input type="text" value="1;2;3;4;5;6" name="tawsil-input-{{$question->question_tawsil_id}}" class="form-control tawsil-input"  style="opacity:0;">

                                        </div>



                                    </div>

                                </div>

                            </div>

                            <div class="step-actions">
                                <!--								<button class="waves-effect waves-dark btn blue next-step" data-feedback="someFunction">CONTINUE</button>
                                -->								<button class="waves-effect waves-dark btn blue next-step">CONTINUE</button>
                                <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                            </div>
                        </div>

                    </li>
                    <?php } ?>
                    <?php foreach($listQuestionsTartib as $question) { ?>
                    <li class="step step-to-shuffle step-5">
                        <div class="step-title waves-effect waves-dark"></div>
                        <div class="step-content">
                            <div class="countdown" style="zoom:0.2;">
                                <svg viewBox="-50 -50 100 100" stroke-width="10">
                                    <circle r="45"></circle>
                                    <circle r="45" stroke-dasharray="282.7433388230814" stroke-dashoffset="282.7433388230814px"></circle>
                                </svg>
                            </div>
                            <?php if($durationExam=='00:00:00'){ ?>
                            <div class="countdown2" alt="<?php if($question->no_specific_time==true ){echo '10:00:00';}else{echo $question->duration;} ?>" style="text-align: center"></div>
                            <?php } ?>
                            <h5>{{$question->title}}</h5>
                            <?php if($question->image !=null) {?>
                            <div style="margin-left:35%;">
                                <img alt="no image" src="{{asset('assets/uploads/'.$question->image)}}"  style="width:240px;"/>
                            </div>
                            <?php } ?>
                            <label>Order this cards correctly :</label>
                            <div class="row justify-content-center"><img src="{{asset('assets/images/dragg.png')}}" alt="Alternate Text" style="width:45px;float:right;"/>
                                <ul id="sortlistOrder{{$question->question_tartib_id}}" class="col-md-6 col-xs-12 sortlistOrder" >
                                <!--<img src="<?php /*echo base_url(); */?>assets/images/dragg.png" alt="Alternate Text" style="width:25px;float:right;"/>-->
                                    <li alt="{{$question->option_to_order_1;}}">
                                        {{$question->option_to_order_1;}}
                                    </li>
                                    <li alt="{{$question->option_to_order_2;}}">
                                        {{$question->option_to_order_2;}}

                                    </li>
                                    <li alt="{{$question->option_to_order_3;}}">
                                        {{$question->option_to_order_3;}}

                                    </li>
                                    <li alt="{{$question->option_to_order_4;}}">
                                        {{$question->option_to_order_4;}}

                                    </li>
                                    <?php if(!empty($question->option_to_order_5)) :?>
                                    <li alt="{{$question->option_to_order_5;}}">
                                        {{$question->option_to_order_5;}}

                                    </li>
                                    <?php endif ;?>
                                    <?php if(!empty($question->option_to_order_6)) :?>
                                    <li alt="{{$question->option_to_order_6;}}">
                                        {{$question->option_to_order_6;}}

                                    </li>
                                    <?php endif ;?>
                                </ul>
                                <input type="text" value="1;2;3;4;5;6" name="tartib-input-{{$question->question_tartib_id;}}" class="form-control tartib-input"  style="opacity:0;">

                            </div>

                            <div class="step-actions">
                                <!--								<button class="waves-effect waves-dark btn blue next-step" data-feedback="someFunction">CONTINUE</button>
                                -->
                                <button class="waves-effect waves-dark btn blue next-step">CONTINUE</button>
                                <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                            </div>
                        </div>
                    </li>
                    <?php } ?>

                    <?php foreach($listQuestionsSpan as $question) { ?>
                    <li class="step step-to-shuffle">
                        <div data-step-label="" class="step-title waves-effect waves-dark"></div>
                        <div class="step-content">
                            <div class="countdown" style="zoom:0.2;">
                                <svg viewBox="-50 -50 100 100" stroke-width="10">
                                    <circle r="45"></circle>
                                    <circle r="45" stroke-dasharray="282.7433388230814" stroke-dashoffset="282.7433388230814px"></circle>
                                </svg>
                            </div>
                            <?php if($durationExam=='00:00:00'){ ?>
                            <div class="countdown2" alt="<?php if($question->no_specific_time==true ){echo '10:00:00';}else{echo $question->duration;} ?>" style="text-align: center"></div>
                            <?php } ?>
                            <?php if($question->image !=null) {?>
                            <div style="margin-left:35%;">
                                <img alt="no image" src="{{asset('assets/uploads/'.$question->image)}}"  style="width:240px;"/>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="col-md-12" >
                                        <div class="form-group">
                                            <label style="text-align:left">{{$question->title}}</label>
                                            <div class="row">
                                                <p class="given text-to-fill-span" contenteditable="true">
                                                    <?php
                                                    $fullstring =$question->span_text;
                                                    //var_dump($fullstring);
                                                    $string=$fullstring;
                                                    $parts=array();
                                                    $wordsConcat=$question->words;
                                                    $num=substr_count($wordsConcat,";");
                                                    $piecesWords=explode(';',$wordsConcat);
                                                    $counter=0;
                                                    $arrayPositions=array();
                                                    for($i=0;$i<$num;$i++) {
                                                        $word = $piecesWords[$i + 1];
                                                        $arrayPositions[strpos($string, $word)]=$word;

                                                    }

                                                    foreach($arrayPositions as $key => $data) {
                                                        ksort($arrayPositions);
                                                        $arrayPositions[$key] = $data;
                                                    }
                                                    $i=0;

                                                    foreach($arrayPositions as $k =>$pos){
                                                        $word=$arrayPositions[$k];
                                                        $counter++;
                                                        $pieces=explode('¤'.$word.'¤',$string);

                                                        $parts[]=$pieces[0];
                                                        if(array_key_exists((1),$pieces)){
                                                            $string=$pieces[1];
                                                        }
                                                        $i++;

                                                        ?>
														<?php
                                                    }
                                                    $parts[]=$string;
                                                    for($i=0;$i<=$counter;$i++){
                                                    if($parts[$i]!=$fullstring){

                                                    ?>
                                                    <span class="w ui-droppable"> {{$parts[$i]}} </span>&nbsp;
                                                    <?php }} ?>
                                                </p>

                                                <input type="text" value="" class="form-control input-text-with-words-span"     name="input-text-with-words-span-{{$question->question_span_id}}" hidden>

                                            </div>

                                            <div class="divider"></div>
                                            <div class="section">
                                                <section>
                                                    <div class="card blue-grey ">
                                                        <div class="card-content white-text">
                                                            <div class="row">
                                                                <div id="walkinDiv" class="col s12">
                                                                    <?php $wordsConcat=$question->words;
                                                                    $num=substr_count($wordsConcat,";");
                                                                    $pieces=explode(';',$wordsConcat);
                                                                    for($i=0;$i<$num;$i++){
                                                                    ?>
                                                                    <span class="given btn-flat white-text red lighten-1" rel="<?php  echo $i+1;?>>">{{$pieces[$i+1]}}</span>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step-actions">
                                <button class="waves-effect waves-dark btn blue next-step">CONTINUE</button>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                    <li class="step finish-step">
                        <div class="step-title waves-effect waves-dark">Finish</div>
                        <div class="step-content">
                            Finish!
                            <div class="step-actions">
                                <a class="waves-effect waves-dark btn blue" type="button" id="submit-form-shown" >SUBMIT</a>
                                <button class="waves-effect waves-dark btn blue" id="submit-form" type="submit" style="">SUBMIT Reeel</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </form>


            <div class="col-md-12" >
                <h5> Copy paste equations from this editor</h5>
                <textarea id="editor"></textarea>
            </div>

        </div><!--/container-->

    </section>
    <div id="dialog" title="Need permission" hidden>
        <p>Allow Camera record to continue the exam !</p>
        <img src="{{asset('assets/images/camera.png')}}" alt="Placeholder Image" style="width:260px;" />

    </div>
    <!-- ========================  Stretcher widget ======================== -->

    <!-- ========================  Cards ======================== -->

    <!-- ========================  Banner ======================== -->


    <!-- ========================  Blog Block ======================== -->

    <!-- ========================  Instagram ======================== -->




    @include('partials/footer')
</div> <!--/wrapper-->
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.0.0/jquery.steps.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://unpkg.com/materialize-stepper@3.1.0/dist/js/mstepper.min.js"></script>
<!-- recommended -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/RecordRTC/5.6.2/RecordRTC.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function(){
        <?php
        if($randomQuestions==true){  ?>
        var grd = $('#horizontal');
        var imgs = grd.children()
        var finish = imgs.last()
        // Page Refresh to run script below
        imgs.sort(function(){
            return (Math.round(Math.random()) - 0.5);
        });
        grd.remove('.step-to-shuffle');
        for(var i=0; i < imgs.length; i++)grd.append(imgs[i]);
        grd.find('.finish-step').remove();
        grd.append(finish[0]);
        <?php } ?>

        // draw test canva
        var img = new Image();
        img.src = $('#src-draw-me').text();
        var ctx = $("canvas")[0].getContext('2d');
        img.onload = function() {
            ctx.drawImage(img, 0, 0);
        };
        var stepper = document.querySelector('.stepper');
        var stepperInstace = new MStepper(stepper, {
            // options
            firstActive: 0, // this is the default
        })
        var currentSteps = stepperInstace.getSteps();
        timerArray=[];


        <?php
        if($durationExam=='00:00:00'){  ?>
        var timer0 = $('.step').first().find('.countdown2').attr('alt');
        timerArray.push(timer0);
        console.log('index= ,'+currentSteps['active']['index'])
        var interval = setInterval(function() {


            var timer = timer0.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[1], 10);
            var seconds = parseInt(timer[2], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            if(timer0=='10:00:00'){
                $('.active .countdown2').hide();
            }else{
                $('.active .countdown2').html(minutes + ':' + seconds);
            }
            timer0 = '00:'+minutes + ':' + seconds;
            if(timer0=='00:0:00'){
                clearInterval(interval);
                var currentSteps = stepperInstace.getSteps();
                var nextStep=currentSteps['active']['index'];
                stepperInstace.nextStep(nextStep+1);

            }
        }, 1000);

        stepper.addEventListener('stepopen', myFunction, true);
        stepper.addEventListener('stepclose', myFunctionClear, true);

        intervalArray=[];
        function myFunction() {
            console.log('inside stepopen')
            var currentSteps = stepperInstace.getSteps();
            console.log('index= ,'+currentSteps['active']['index'])
            if(currentSteps['active']['index']>-2){
                timerArray.push(currentSteps['active']['step'].querySelector('.countdown2').getAttribute('alt'));



                if(currentSteps['active']['step'].querySelector('.countdown2')){
                    //clearInterval(interval);


                    orderTimer=currentSteps['active']['index'];
                    console.log('order: ',orderTimer)
                    console.log('timerArray=',timerArray)
                    timer2=timerArray[orderTimer]
                    console.log('timer2'+timer2)
                    for (var i = 1; i < 99999; i++){
                        window.clearInterval(i);
                    }
                    var interval2 = setInterval(function() {
                        console.log('io',timer2)
                        var timer = timer2.split(':');
                        //by parsing integer, I avoid all extra string processing
                        var minutes = parseInt(timer[1], 10);
                        var seconds = parseInt(timer[2], 10);
                        --seconds;
                        minutes = (seconds < 0) ? --minutes : minutes;
                        if (minutes < 0) clearInterval(interval2);
                        seconds = (seconds < 0) ? 59 : seconds;
                        seconds = (seconds < 10) ? '0' + seconds : seconds;
                        //minutes = (minutes < 10) ?  minutes : minutes;
                        if(timer2=='10:00:00'){
                            $('.active .countdown2').hide();
                        }else{
                            $('.active .countdown2').show();
                            $('.active .countdown2').html(minutes + ':' + seconds);
                        }

                        timer2 = '00:'+minutes + ':' + seconds;
                        if(timer2=='00:0:00'){
                            clearInterval(interval2);
                            var currentSteps = stepperInstace.getSteps();
                            var nextStep=currentSteps['active']['index'];
                            stepperInstace.nextStep(nextStep+1);
                        }
                    }, 1000);

                    intervalArray.push(interval2);
                    console.log('push int',intervalArray)

                }

            }
        }

        <?php } ?>

        function myFunctionClear() {

        }

        //video recorder lanch on start


        // screen recorder of the user
        let btn = document.querySelector(".record-btn");



        const myTimeout = setTimeout(recordStart, 2000);
        const myTimeout2 = setTimeout(recordVideoStart, 5000);
        function recordStart(){
            <?php
            if($allowScreenRecord==true){  ?>
            btn.click();
            <?php } ?>
        }
        function recordVideoStart(){
            <?php if($allowCameraRecord==true) {  ?>
            $('#btn-start-recording').click();
            <?php } ?>
        }

        btn.addEventListener("click", async function () {
            try {
                stream = await navigator.mediaDevices.getDisplayMedia({
                    video: true
                });
            } catch (error) {
                alert('Please Allow Screen Record !');
                window.location.reload();
                // Expected output: ReferenceError: nonExistentFunction is not defined
                // (Note: the exact output may be browser-dependent)
            }

            //needed for better browser support
            const mime = MediaRecorder.isTypeSupported("video/webm; codecs=vp9")
                ? "video/webm; codecs=vp9"
                : "video/webm"
            mediaRecorder = new MediaRecorder(stream, {
                mimeType: mime
            })
            mediaRecorder.addEventListener("error", (event) => {
                console.error(`error recording stream: ${event.error.name}`);
            });
            let chunks = []
            mediaRecorder.addEventListener('dataavailable', function(e) {
                chunks.push(e.data)
            })



            mediaRecorder.addEventListener('stop', function(){
                let blob = new Blob(chunks, {
                    type: chunks[0].type
                })
                let url = URL.createObjectURL(blob)

                let video = document.querySelector("video")
                video.src = url


                uploadScreenToServer(blob)
                console.log(url);


                //let a = document.createElement('a')
                //a.href = url
                //a.download = 'video.webm'
                //a.click()
            })
            //we have to start the recorder manually
            try {
                mediaRecorder.start()
            } catch (error) {
                console.error(error);
                // Expected output: ReferenceError: nonExistentFunction is not defined
                // (Note: the exact output may be browser-dependent)
            }


        });

        // Add a validation function to the stepper

        $('.sortlist > li').mouseleave(function() {
            var inputTawsil=$(this).parent().parent().find('.tawsil-input');
            var listTawsil=$(this).parent().find('li');
            var concatTawsilOrder=';'
            listTawsil.each(function(){
                concatTawsilOrder=concatTawsilOrder+$(this).attr('alt')+';';

            });
            inputTawsil.val(concatTawsilOrder);
        });

        $('.sortlistOrder > li').mouseleave(function() {
            var inputTartib=$(this).parent().parent().find('.tartib-input');
            var listTawsil=$(this).parent().find('li');
            var concatTartibOrder=';'
            listTawsil.each(function(){
                concatTartibOrder=concatTartibOrder+$(this).attr('alt')+';';

            });
            inputTartib.val(concatTartibOrder);
        });
        $('.sortlistOrder').each(function (){
            id=$(this).attr('id');
            slist(document.getElementById(id));
        });
        $('.sortlist').each(function (){
            idSort=$(this).attr('id');
            console.log(idSort)
            slist(document.getElementById(idSort));
        });


        $('.sortlistOrder').each(function (){
            id=$(this).attr('id');
            htmlShuffle('#'+id);
        });
        $('.sortlist').each(function (){
            idSort=$(this).attr('id');
            htmlShuffle('#'+idSort);
        });


        /* treatement card select */
        $('.card-options-multiple').click(function (){
            var id=$(this).attr('id');
            var orderValue=$(this).attr('alt');
            //$('.'+id+' .card-options').removeClass('activated-card');

            //$('.'+id+' #select-options-cards option').removeAttr("selected");
            if($('.'+id+' #select-options-cards option[value='+orderValue+']').is(':selected')){
                $(this).removeClass('activated-card');
                $('.'+id+' #select-options-cards option[value='+orderValue+']').removeAttr("selected");
            }else{
                $(this).addClass('activated-card');
                $('.'+id+' #select-options-cards option[value='+orderValue+']').attr('selected','selected');
            }

        });
        $('.card-options').click(function (){
            var id=$(this).attr('id');
            var orderValue=$(this).attr('alt');
            $('.'+id+' .card-options').removeClass('activated-card');
            $(this).addClass('activated-card');
            $('.'+id+' #select-options-cards option').removeAttr("selected");
            $('.'+id+' #select-options-cards option[value='+orderValue+']').attr('selected','selected');
        });


        //duration submit form
        $('#submit-form-shown').click(function (){
            <?php if($allowCameraRecord==true) {  ?>
            $('#btn-stop-recording').click();
            <?php } ?>
            if(typeof mediaRecorder != "undefined" ){
                mediaRecorder.stop()
            }

            const myTimeout = setTimeout(waitME, 2000);
            function waitME (){
                //$('#submit-form').click();
            }
        })
        /*$('.sortlistOrder').each(function (){
            id=$(this).attr('id');
            console.log(id);
            htmlShuffle(id);
        });

        htmlShuffle('.sortlist');*/
        //convert date exam to seconds

        <?php
        if($durationExam!='00:00:00' && isset($durationExam)){

        $pieces = explode(":", $durationExam);
        $durationSeconds= 0;
        if(array_key_exists(0,$pieces) && array_key_exists(1,$pieces) && array_key_exists(2,$pieces)){
        $durationSeconds= (int)$pieces[0]*3600+(int)$pieces[1]*60+(int)$pieces[2];
        }
        //$durationSeconds= '10';
        $date = date("m/d/Y H:i:s");
        $newDate = date('m/d/Y H:i:s', strtotime($date. ' +'.$durationSeconds.' seconds'));
        ?>
        $('#global').countdown({
            date: '{{$newDate}}',
            offset: +1,
            day: 'Day',
            days: 'Days',
            hideOnComplete: true
        }, function (container) {
            //$('#submit-form').click();
        });
        <?php } ?>


        /*section drag and drop*/
        $('.w .ui-icon-close').each(function (){
            console.log('span')
            $(this.parent().attr('color','green'))
        })
        $("p.given").html(chunkWords($("p.given").text()));

        var arabic = /[\u0600-\u06FF]/;
        if(arabic.test($("p.given").html())){
            $("p.given").css('direction','rtl')
        }
        $("span.given").draggable({
            helper: "clone",
            revert: "invalid"
        });
        console.log($("p.given span.w"))
        makeDropText($("p.given span.w"));

        $('.text-to-fill-span').find('.icon-hand').last().remove();

        function textWrapper(str, sp,classification) {
            if (sp == undefined) {
                sp = [0, 0];
            }

            if($.trim(str)==''){
                var txt = "";
            }else{
                if(classification=='0'){
                    var txt = "<span class='w'>" + str + "</span>";

                }else{
                    if(classification=='2') {
                        var txt = "<span class='w' style='border-bottom: 3px solid green;'>" + str + "</span>";
                    }else {
                        var txt = "<span class='w'>" + str + "</span><i class='icon icon-hand'></i>";
                    }
                }
            }


            /*if (sp[0]) {
                txt = "&nbsp;" + txt;
            }

            if (sp[1]) {
                txt = txt + "&nbsp;";
            }*/

            return txt;
        }

        function chunkWords(p) {
            var words = p.split(" ");
            words[0] = textWrapper(words[0], [0, 1],'0');

            var i;
            var num=[];
            var word=[];
            console.log('lenght',words.length)
            for (i = 1; i < words.length; i++) {
                if($.trim(words[i])!=''){
                    num.push(i);
                    word.push(words[i]);
                    console.log('ww',words[i])
                    if (words[0].indexOf(".")) {

                        words[i] = textWrapper(words[i], [1, 0],'1');
                    } else {
                        words[i] = textWrapper(words[i], [1, 1],'1');
                    }
                }

            }
            num.forEach( treatWord);
            function treatWord(item, index) {
                textWrapper(words[item], [1, 0],'1');
            }

            console.log('last=',words[words.length-1])
            return words.join("");
        }

        function makeBtn(tObj) {
            var btn = $("<span>", {
                class: "ui-icon ui-icon-close"
            }).appendTo(tObj);
            btn.click(function(e) {
                $(this).parent().remove();
            });
        }

        function makeDropText(obj) {
            return obj.droppable({
                drop: function(e, ui) {
                    var txt = ui.draggable.text();
                    console.log("makedrop",txt)
                    var newSpan = textWrapper(txt, [1, 0],'2');
                    $(this).after(newSpan);
                    makeBtn($(this).next("span.w"));
                    makeDropText($(this).next("span.w"));
                    $("span.w.ui-state-highlight").removeClass("ui-state-highlight");
                },
                over: function(e, ui) {
                    $(this).add($(this).next("span.w")).addClass("ui-state-highlight");
                },
                out: function() {
                    $(this).add($(this).next("span.w")).removeClass("ui-state-highlight");
                }
            });
        }

    });
    function onDragStart(event) {
        event
            .dataTransfer
            .setData('text/plain', event.target.id);

        event
            .currentTarget
            .style
            .backgroundColor = 'yellow';
    }
    function onDragOver(event) {
        event.preventDefault();
    }

    function onDrop(event) {
        const id = event
            .dataTransfer
            .getData('text');

        const draggableElement = document.getElementById(id);
        const dropzone = event.target;
        dropzone.appendChild(draggableElement);
        event
            .dataTransfer
            .clearData();
    }

    /* drag js func */
    function slist (target) {
        // (A) SET CSS + GET ALL LIST ITEMS
        if(target){
            target.classList.add("slist");
            let items = target.getElementsByTagName("li"), current = null;

            // (B) MAKE ITEMS DRAGGABLE + SORTABLE
            for (let i of items) {
                // (B1) ATTACH DRAGGABLE
                i.draggable = true;

                // (B2) DRAG START - YELLOW HIGHLIGHT DROPZONES
                i.ondragstart = e => {
                    current = i;
                    for (let it of items) {
                        if (it != current) { it.classList.add("hint"); }
                    }
                };

                // (B3) DRAG ENTER - RED HIGHLIGHT DROPZONE
                i.ondragenter = e => {
                    if (i != current) { i.classList.add("active"); }
                };

                // (B4) DRAG LEAVE - REMOVE RED HIGHLIGHT
                i.ondragleave = () => i.classList.remove("active");

                // (B5) DRAG END - REMOVE ALL HIGHLIGHTS
                i.ondragend = () => { for (let it of items) {
                    it.classList.remove("hint");
                    it.classList.remove("active");
                }};

                // (B6) DRAG OVER - PREVENT THE DEFAULT "DROP", SO WE CAN DO OUR OWN
                i.ondragover = e => e.preventDefault();

                // (B7) ON DROP - DO SOMETHING
                i.ondrop = e => {
                    e.preventDefault();
                    if (i != current) {
                        let currentpos = 0, droppedpos = 0;
                        for (let it=0; it<items.length; it++) {
                            if (current == items[it]) { currentpos = it; }
                            if (i == items[it]) { droppedpos = it; }
                        }
                        if (currentpos < droppedpos) {
                            i.parentNode.insertBefore(current, i.nextSibling);
                        } else {
                            i.parentNode.insertBefore(current, i);
                        }
                    }
                };
            }
        }

    }
    /* shuffle ul liste  */
    function htmlShuffle(elem) {
        function shuffle(arr) {
            var len = arr.length;
            var d = len;
            var array = [];
            var k, i;
            for (i = 0; i < d; i++) {
                k = Math.floor(Math.random() * len);
                array.push(arr[k]);
                arr.splice(k, 1);
                len = arr.length;
            }
            for (i = 0; i < d; i++) {
                arr[i] = array[i];
            }
            return arr;
        }
        var el = document.querySelectorAll(elem + " *");
        document.querySelector(elem).innerHTML = "";

        let pos = [];
        for (let i = 0; i < el.length; i++) {
            pos.push(i);
        }

        pos = shuffle(pos);
        for (let i = 0; i < pos.length; i++) {
            document.querySelector(elem).appendChild(el[pos[i]]);
        }
    }


    var video = document.querySelector('video');

    function captureCamera(callback) {
        navigator.mediaDevices.getUserMedia({ audio: true, video: true }).then(function(camera) {
            callback(camera);
        }).catch(function(error) {
            $('#dialog').show();
            $( "#dialog" ).dialog({
                close: function(event, ui) { window.location.reload(); },
            });

        });
    }

    function stopRecordingCallback() {
        video.src = video.srcObject = null;
        video.muted = false;
        video.volume = 1;
        video.src = URL.createObjectURL(recorder.getBlob());



        recorder.camera.stop();
        uploadToServer(recorder.getBlob())
        recorder.destroy();
        recorder = null;



    }
    function uploadToServer(recordRTC) {
        var blob = recordRTC instanceof Blob ? recordRTC : recordRTC.blob;
        var fileType = blob.type.split('/')[0] || 'audio';
        var fileName = (Math.random() * 1000).toString().replace('.', '');

        if (fileType === 'audio') {
            fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
        } else {
            fileName += '.webm';
        }
        $('#video-url-input').val(fileName);
        // create FormData
        var formData = new FormData();
        formData.append(fileType + '-filename', fileName);
        formData.append(fileType + '-blob', blob);

        //callback('Uploading ' + fileType + ' recording to server.');

        // var upload_url = 'https://your-domain.com/files-uploader/';
        var upload_url = 'index.php/student/save-video';

        // var upload_directory = upload_url;
        var upload_directory = 'uploads/';

        makeXMLHttpRequest(upload_url, formData, function(progress) {
            if (progress !== 'upload-ended') {
                //callback(progress);
                return;
            }

            //callback('ended', upload_directory + fileName);

            // to make sure we can delete as soon as visitor leaves
            listOfFilesUploaded.push(upload_directory + fileName);
        });
    }

    function uploadScreenToServer(recordRTC) {
        var blob = recordRTC
        var fileType = 'video';
        var fileName = (Math.random() * 1000).toString().replace('.', '');

        $('#screen-url-input').val(fileName+'.webm');
        // create FormData
        var formData = new FormData();
        formData.append(fileType + '-filename', fileName);
        formData.append(fileType + '-blob', blob);

        //callback('Uploading ' + fileType + ' recording to server.');

        // var upload_url = 'https://your-domain.com/files-uploader/';
        var upload_url = 'index.php/student/save-screen-video';

        // var upload_directory = upload_url;
        var upload_directory = 'uploads/';

        makeXMLHttpRequest(upload_url, formData, function(progress) {
            if (progress !== 'upload-ended') {
                //callback(progress);
                return;
            }

            //callback('ended', upload_directory + fileName);

            // to make sure we can delete as soon as visitor leaves
            listOfFilesUploaded.push(upload_directory + fileName);
        });
    }
    function makeXMLHttpRequest(url, data, callback) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                //callback('upload-ended');
            }
        };



        request.open('POST', url);
        request.send(data);
    }
    var recorder; // globally accessible

    document.getElementById('btn-start-recording').onclick = function() {
        this.disabled = true;
        captureCamera(function(camera) {
            video.muted = true;
            video.volume = 0;
            video.srcObject = camera;

            try {
                recorder = RecordRTC(camera, {
                    type: 'video'
                });
            } catch (error) {
                console.error('err',error)
                // Expected output: ReferenceError: nonExistentFunction is not defined
                // (Note: the exact output may be browser-dependent)
            }


            recorder.startRecording();

            // release camera on stopRecording
            recorder.camera = camera;

            document.getElementById('btn-stop-recording').disabled = false;
        });
    };

    document.getElementById('btn-stop-recording').onclick = function() {
        this.disabled = true;
        <?php if($allowCameraRecord==true) {  ?>
        recorder.stopRecording(stopRecordingCallback);
        <?php } ?>
    };

    setInterval(putPtoInput, 1000);
    function putPtoInput() {
        textToPut=$('.text-to-fill-span');
        $('.text-to-fill-span').each(function (){

            $(this).parent().find('.input-text-with-words-span').val($(this).text().replace(/\s\s+/g, ' '))
        })
        //console.log($('.text-to-fill-span').parent().find('input-text-with-words-span'));

    }

    /* script canva draw */
    var color = $(".selected").css("background-color");
    var context = $("canvas")[1].getContext("2d");
    var $canvas = $("canvas");
    var lastEvent;
    var mouseDown = false;
    let canvas = document.getElementById("draw-new");
    let ctx = canvas.getContext("2d");
    //when clicking on control list items
    $(".controls").on("click", "li", function() {
        //deselect sibling elements
        $(this).siblings().removeClass("selected");
        //select clicked element
        $(this).addClass("selected");
        //cache current color
        color = $(this).css("background-color");
    });

    //when add color is pressed
    $("#revealColorSelect").click(function() {
        //show or hide color select
        changeColor();
        $("#colorSelect").toggle();
    });

    //update newcolor span
    function changeColor() {
        var r = $("#red").val();
        var g = $("#green").val();
        var b = $("#blue").val();
        $("#newColor").css("background-color", "rgb(" + r + "," + g + "," + b + ")");
    }
    function saveCanvas() {
        const imageURI = $("canvas")[0].toDataURL("image/png");
        $('#data-file-uploaded-multi-1').val(imageURI)

        /* var img = new Image();
         img.src = "";
         var ctx = $("canvas")[1].getContext('2d');
         img.onload = function() {
             ctx.drawImage(img, 0, 0);
         };
*/

        //el.href = imageURI;
        //$("body").append(image);
        /*var file = dataURLtoFile(image.src, 'canvas.png');
        console.log(file);
        $('#file-uploaded-multi-1').attr('src', image.src);
        $('#file-uploaded-multi-1').prop('files', file);*/
        // Convert the data URL to a Blob object
        /*var blob = dataURLToBlob(imageURI);
        console.log(blob)/!*
        // Create a file object from the Blob
        var file = new File([blob], "myimage.png", { type: "image/png" });
         console.log(file)
        // Set the value of the file input field to the file object*!/



             // create a new blob URL from the blob
             var blobUrl = URL.createObjectURL(blob);

             // create a new image element and set its source to the blob URL
             var img = new Image();
             img.src = blobUrl;

             // append the image element to the file input label
             var label = $("label[for='file-uploaded-multi-1']");
             label.append(img);

             // add an event listener to the file input
             var fileInput = document.getElementById("file-uploaded-multi-1");
             fileInput.addEventListener("change", function(event) {
                 var file = event.target.files[0];
                 console.log("Selected file: " + file.name);
             });*/


    }
    //when color sliders changed
    $("input[type=range]").change(changeColor);

    //when add color is pressed
    $("#addNewColor").click(function() {
        //append color to the controls ul
        var $newColor = $("<li></li>");
        $newColor.css("background-color", $("#newColor").css("background-color"));
        $(".controls ul").append($newColor);
        $newColor.click();
    });

    //on mouse events on canvas
    $canvas.mousedown(function(e) {
        lastEvent = e;
        mouseDown = true;
    }).mousemove(function(e) {
        //Draw lines
        if (mouseDown) {
            context.beginPath();
            context.moveTo(lastEvent.offsetX, lastEvent.offsetY);
            context.lineTo(e.offsetX, e.offsetY);
            context.strokeStyle = color;
            context.stroke();
            lastEvent = e;
        }
    }).mouseup(function() {
        mouseDown = false;
    }).mouseleave(function() {
        $canvas.mouseup();
        saveCanvas();
    });
</script>
<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'powerpaste casechange searchreplace autolink directionality advcode visualblocks visualchars image link media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker editimage help formatpainter permanentpen charmap linkchecker emoticons advtable export autosave',
        toolbar: 'undo redo print spellcheckdialog formatpainter | blocks fontfamily fontsize | bold italic underline forecolor backcolor | link image | alignleft aligncenter alignright alignjustify lineheight | checklist bullist numlist indent outdent | removeformat',
        height: '700px',
        menu: {
            file: { title: 'File', items: 'newdocument restoredraft | preview | export print | deleteallconversations' },
            edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
            view: { title: 'View', items: '' },
            insert: { title: 'Insert', items: ' link   pageembed template codesample  | charmap emoticons hr |     | insertdatetime' },
            format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
            tools: { title: 'Tools', items: '' },
            table: { title: 'Table', items: '' },
            help: { title: 'Help', items: '' }
        }
    });
</script>
</html>
