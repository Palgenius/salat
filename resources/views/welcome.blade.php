@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class='row'>
            <div class="col-lg-4 div-times">
                <br>
                <h2 class="text-center prayer-times"> مواقيت الصلاة </h2>
                <ul class="list-times">
                    <li>
                        <span class="name"> الفجر </span>
                        <span class="time"> 04:51 </span>
                    </li>
                    <li>
                        <span class="name"> الفجر </span>
                        <span class="time"> 04:51 </span>
                    </li>
                    <li>
                        <span class="name"> الفجر </span>
                        <span class="time"> 04:51 </span>
                    </li>
                    <li>
                        <span class="name"> الفجر </span>
                        <span class="time"> 04:51 </span>
                    </li>
                    <li>
                        <span class="name"> الفجر </span>
                        <span class="time"> 04:51 </span>
                    </li>
                    <li>
                        <span class="name"> الفجر </span>
                        <span class="time"> 04:51 </span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-1">
            </div>
            <div class="col-lg-6">
               <!-- <h1 class="text-center mosque-name"> مسجد بدر </h1>-->
                <h1 class="text-center ctime" id="ctime"> </h1>
                <h1 class="text-center"> <span id="hijri"></span> <span id="separatetime">|</span> <span id="melady"></span></h1>
                <br>
                <div id='area' class="area">

                </div>

            </div>
        </div>
    </div>



    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div  id="imageModal" class="modal-content">

        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            // alert('from jquery');
            setInterval(function () {
                axios.get("{{ route('salat') }}")
                    .then(function (response) {
                        // handle success

                        if(response.data.background){

                            var bg_img = $('body').css( 'background-image' );
                         //   console.log(bg_img+" "+response.data.background);
                            if(response.data.background != bg_img){
                                console.log(response.data.background != bg_img);
                                $('body').css('background-image',response.data.background);
                            }
                        }

                        var content =$("#area").html();

                        if(response.data.area){
                            if (content.length <10 || !response.data.area.startsWith(content.substring(0,75))) {
                                $("#area").html(
                                    response.data.area
                                );
                            }
                        }
                        else {
                            $("#area").html('');
                        }




                        var hour=((response.data.carbon.hour>12)?(response.data.carbon.hour-12):response.data.carbon.hour);
                        //console.log(response.data);
                        $("#ctime").text((hour+'').padStart(2,'0')+':'
                            +(response.data.carbon.minute+'').padStart(2,'0')+':'
                            +(response.data.carbon.second+'').padStart(2,'0')
                            +((response.data.carbon.hour>12)?" م ":" ص ")
                        );
                        $("#hijri").text(response.data.hijri);
                        $("#melady").text(formatDate(response.data.carbon.formatted));
                        $(".list-times li").remove();

                        $.each(response.data.ar_times,function(index, item) {
                            $(".list-times").append('<li><span class="time">' +((item.value.length<5)?"0":"")+item.value+ '</span><span class="name">'+ item.key +'</span></li>');
                        });


                        if( response.data.eqamaAfter){
                            if(response.data.eqamaAfter.type=='s' && response.data.eqamaAfter.value == 10) azan();
                            // $("#area").html
                            $(".list-times").append(
                                '<li>'+
                                '<h3  class="text-center time" style="color: white;font-size: 2.0vw;" > '+'الوقت المتبقي لاقامة صلاة '+response.data.eqamaAfter.key+'</h3>'+
                                '<h3  class="text-center time" style="color: red; float: none ;"> '+((response.data.eqamaAfter.type=='s')? 'ثانية ' : 'دقيقة ' )+response.data.eqamaAfter.value+
                                '</h3></li>');
                        }

                        if( response.data.adanAfter){
                            if(response.data.adanAfter.type=='s' && response.data.adanAfter.value == 10) azan();

                            // $("#area").html
                            $(".list-times").append(
                                '<li>'+
                                '<h3  class="text-center time" style="color: white;font-size: 2.0vw;"> '+'الوقت المتبقي لصلاة '+response.data.adanAfter.key+'</h3>'+
                                '<h3  class="text-center time" style="color: red;float: none "> '+((response.data.adanAfter.type=='s')? 'ثانية ' : 'دقيقة ' )+response.data.adanAfter.value+
                                '</h3></li>');
                        }
                        var modal = document.getElementById("myModal");
                        var modalcontent = $("#imageModal").html();

                        if(response.data.imageModal){
                            if (modalcontent.length <10 || !response.data.imageModal.startsWith(modalcontent.substring(0,70))) {
                                $("#imageModal").html(response.data.imageModal);

                            }
                        }

                        if(response.data.showModal){
                          //imageModal
                            modal.style.display = "block";
                        }
                        else {
                            modal.style.display = "none";
                        }

                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }



                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function () {

                    });
            }, 1000);

        });

        function formatDate(date) {
            date=new Date(date);
            var monthNames = [
                "يناير", "فبر اير", "مارس",
                "أبريل", "مايو", "يونيو", "يوليو",
                "أغسطس", "سبتمبر", "أكتوبر",
                "نوفيمبر", "ديسمبر"
            ];

            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();

            return day + ' ' + monthNames[monthIndex] + ' ' + year;
        }

        function azan(){
            var sound = new Howl({
                src: ['{{ asset("mp3/a.mp3") }}'],
                volume: 0.5,
                onend: function () {
                    //  alert('Finished!');
                }
            });
            sound.play()
        }
    </script>

@endsection
