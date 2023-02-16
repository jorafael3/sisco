<html>
<head>
<title>Sistema SISCO</title>

 <script type="text/javascript" src="jquery-2.1.4.min.js"> </script>
 <script type="text/javascript">     
     setInterval(function get() {
        $.post('data.php', { name: form.name.value},
            function(output) {
               $('#info').html(output).show();            
            });    
     }, 15000)
 </script>

</head>
<body>
</body>
</html>


