<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div id="time" style="color: #fdfdfd; background-color: transparent;width: 140px;
    height: 21px; font-size: 12px; font-family: Arial;font-weight: bold;">
        
    </div>
  
    <script type="text/javascript">
        updateTime();
        function updateTime() {
            $.ajax({
                url: 'https://enam.gov.in/web/Enam_ctrl/showTimeStamp',
                method: 'POST',
                dataType: 'json',
                success: function(data) {   
                    $.each(data, function(key, value) {
                        $('#time').html(spliFunction(value.current_timestamp));   
                    });
                }
            });
        }
     
        $(function() {
            setInterval(updateTime, 1000);
        });

        function spliFunction(testDate){
            var dateWithoutSecond = new Date(testDate);
            let getSplitDate = testDate.split(' ')[0];
            let getSplitTime = testDate.split(' ')[1];
            let finalRes = `${getSplitDate.split('-')[2]}/${getSplitDate.split('-')[1]}/${getSplitDate.split('-')[0]} ${getSplitTime}`;

            return finalRes;
        }

    </script>
</body>
</html>
