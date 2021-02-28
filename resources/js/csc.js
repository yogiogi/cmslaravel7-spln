$(document).ready(function(){
    var host = window.location.href;    
    $("#provincy").change(function() {
            $.getJSON(host + "/getKabupaten/" + $("#provincy option:selected").val(), function(data) {
             console.log("datas " + data);            

                var temp = [];
                //CONVERT INTO ARRAY
                $.each(data, function(key, value) {
                    temp.push({v:value, k: key});
                });

                //SORT THE ARRAY
                temp.sort(function(a,b){
                   if(a.v > b.v){ return 1}
                    if(a.v < b.v){ return -1}
                      return 0;
                });

                //APPEND INTO SELECT BOX
                $('#regency').empty();
                $('#regency').append('<option>--Pilih Kabupaten--</option>');
                $.each(temp, function(key, obj) {
                    $('#regency').append('<option value="' + obj.k +'">' + obj.v + '</option>');
                });
            });                
        }); 
});//end of document ready