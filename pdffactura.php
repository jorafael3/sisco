
<?php
				  
		
		$fname2= $_GET['aut'];	
		//$fname2 = $_SESSION['aut']; 
		showFile($fname2); 
		
     function showFile($fname) {
		 
		 
		  
          $opts = [
            "http" => [
                "method" => "GET",
                "header" => "keyClient: compu202009"  
 
                    ]
                ];
                $context = stream_context_create($opts);
				//echo $fname; 
				//echo '<pre>', print_r($opts),'</pre>';
				//echo '<pre>', print_r($context),'</pre>';
                try {
                       $response = file_get_contents('http://10.5.1.185:90/api/Files/GetPdfFile?fileName='.$fname,false,$context);
					   	 
                        if (strpos($http_response_header[0], "200")) { 
                            echo "SUCCESS";

                             header('Content-Type: application/pdf');

                             echo $response;
			 

                         } else { 
                            echo "FACTURA NO AUTORIZADA POR EL SRI";
                         } 

                } catch (Exception $e) {
                    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                }  

          }

     ?>
        