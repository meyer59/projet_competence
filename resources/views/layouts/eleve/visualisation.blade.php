@extends("layouts.eleve.template_eleve")
@section('title', 'menu')
@section("content_body")
    @parent
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div  class="page-content" style="min-height:1080px">
            <!-- BEGIN PAGE HEAD-->
                 <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1> Mes notes
                            <small>Compte etudiant - ORT Lyon <script type="text/javascript"> 
                                    d = new Date(); 
                                  document.write(" - "); 
                                  document.write(d.toLocaleDateString()); 
                                 document.write(" &nbsp;");
                                </script></small>
                        </h1>
            </div>
            <!-- END PAGE TITLE -->
            <!-- BEGIN PAGE TOOLBAR -->
            <!-- END PAGE TOOLBAR -->
        </div>
                 <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="form_wizard_1">
                    <div class="portlet-title">
                        <h1 align="center">Mes resultats d'auto evaluation. </h1>
                        <br>
                        <div class="caption">
                                        <span class="caption-subject font-red bold uppercase"> Du plus recent au plus ancien      
                                        </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                            <div class="form-wizard">
                                <style>
                                     #global {
                                    position: relative; 
                                    margin-left: auto;
                                    margin-right: auto;
                                    width: 1400px;
                                            }
                                </style>
                                <div class="form-body">
                                    
                                    <ul class="nav nav-pills nav-justified steps" >
                                        <div id="global">

                                            <div class="row">
                                                         
                                                
                                                
                                                
                                                    <!--Debut cration de toute les table -->
                                                     <?php
                                                     
                                                                    $nbbcompetence = 0;
                                                                    $maitrise = 0;
                                                                    $acquis = 0;
                                                                    $encours = 0;
                                                                    $arenfocer = 0;
                                                                    $nonacquis = 0;


                                                     
                                                     
                                                        if(isset($resultnote)){
                                                            
                                                           foreach ($resultnote[0] as $var1 => $cle1)
                                                               {
                                                               
                                                               
                                                               
                                                               
                                                               
                                                               
                                                                   foreach ($resultnote[1] as $var => $cle)
                                                                            {
                                                                                
                                                                              
                                                                                foreach($cle as $result => $valeur )
                                                                                {
                                                                                   
                                                                             foreach($cle as $hot){
                                                                                
                                                                                     if ($hot == $cle1 ){
                                                                                    
                                                                    
                                                                                                if($result == "note_autoEval")
                                                                                                {
                                                                                                   $acquisition = "";
                                                                                                      switch ($valeur) // pour preciser la note en fonction du resultat
                                                                                                       {
                                                                                                           case 1:
                                                                                                               
                                                                                                               $nonacquis++;
                                                                                                               break;
                                                                                                           case 2:
                                                                                                               
                                                                                                              $encours++;
                                                                                                               break;
                                                                                                           case 3:
                                                                                                                $arenfocer++;                                                                                                            
                                                                                                               break;
                                                                                                           case 4:
                                                                                                              $acquis++;
                                                                                                               break;
                                                                                                           case 5:
                                                                                                               $maitrise++;
                                                                                                               break;
                                                                                                       } 
                                                                                                          
                                                                                                   }
                                                                                                   
                                                                                                  
      
                                                                                           }
                                                                                            
                                                                                }
                                                                               }
                                                                             
                                                                            }   
                                                                            
                                                                            $tablecouleur = array();
                                                     
                                                                            

                                                                             $max = array ($maitrise, $acquis, $encours, $arenfocer, $nonacquis);
                                                               
                                                                              switch(max($max))
                                                                             {
                                                                                                           case $maitrise:
                                                                                                               $couleur = "green-jungle";
                                                                                                               break;
                                                                                                           case $acquis:
                                                                                                               $couleur = "green-meadow";
                                                                                                               break;
                                                                                                           case $encours:
                                                                                                               $couleur= "yellow-saffron";
                                                                                                               break;
                                                                                                           case $arenfocer:
                                                                                                               $couleur= "yellow-gold";
                                                                                                               break;
                                                                                                           case $nonacquis:
                                                                                                               $couleur= "red-intense";
                                                                                                               break;
                                                                                                           default:
                                                                                                                $couleur= "blue";
                                                                             }
                                                                              
                                                                            
                                                                            
                                                               
                                                               
                                                               
                                                                   echo '<div class="portlet box '.$couleur.'">                                                          
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class="fa fa-newspaper-o"></i> Matière : '.$cle1.'<h5> &nbsp &nbsp &nbsp &nbsp 
                                                                        Maîtrisé : '.$maitrise.' &nbsp &nbsp 
                                                                        Acquis : '.$acquis.' &nbsp &nbsp 
                                                                        En cours d\'aquisition : '.$encours.' &nbsp &nbsp 
                                                                        A renforcer : '.$arenfocer.'&nbsp &nbsp                        
                                                                        Non acquis : '.$nonacquis.' </h5></div>
                                                                <div class="tools">
                                                                    <a href="javascript:;" class="expand" data-original-title="" title="" > </a> 
                                                                    <a class="fullscreen" href="javascript:;" > </a>
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body portlet-collapsed">
                                                                <div class="table-responsive">
                                                                    <br>
                                                                    <table class="table table-striped table-bordered table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="text-align: center;"> Date d\'evaluation </th>
                                                                                <th style="text-align: center;"> Note </th>
                                                                                <th style="text-align: center;"> Commentaire eleve  </th>
                                                                                <th style="text-align: center;"> Competence evaluée  </th> 
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>';?>
                                                                            <?php
                                                                            
                                                                            $maitrise = 0;
                                                                            $acquis = 0;
                                                                            $encours = 0;
                                                                            $arenfocer = 0;
                                                                            $nonacquis = 0;
                                                                            if(isset($resultnote)){
                                                                            foreach ($resultnote[1] as $var => $cle)
                                                                            {
                                                                                
                                                                                echo "<tr>";
                                                                                foreach($cle as $result => $valeur )
                                                                                {
                                                                                   
                                                                             foreach($cle as $hot){
                                                                                  // var_dump($hot); 
                                                                                     if ($hot == $cle1 ){
                                                                                    
                                                                                               if($result == "date_autoEval")
                                                                                                {
                                                                                                   echo " <td align='center' style='width: 200px;'> $valeur</td> ";

                                                                                                }
                                                                                                if($result == "nom_competence")
                                                                                                {
                                                                                                   echo " <td style='font-weight:bold;'> $valeur</td> ";

                                                                                                }
                                                                                                if($result == "commentaire")
                                                                                                {
                                                                                                   if($valeur)
                                                                                                       echo " <td> $valeur</td> ";
                                                                                                   else
                                                                                                       echo " <td style='font-style: italic;'>Pas de commentaire</td> ";                                                                                               
                                                                                                } 
                                                                                                if($result == "note_autoEval")
                                                                                                {
                                                                                                   $acquisition = "";
                                                                                                      switch ($valeur) // pour preciser la note en fonction du resultat
                                                                                                       {
                                                                                                           case 1:
                                                                                                               $acquisition = "Non acquis";
                                                                                                               $couleurtd = "#F5A9A9";
                                                                                                               break;
                                                                                                           case 2:
                                                                                                               $acquisition = "En cours d'aquisition";
                                                                                                               $couleurtd = "#F5D0A9";
                                                                                                               break;
                                                                                                           case 3:
                                                                                                               $acquisition = "A renforcer";
                                                                                                               $couleurtd = "#F2F5A9";
                                                                                                               break;
                                                                                                           case 4:
                                                                                                               $acquisition = "Acquis";
                                                                                                               $couleurtd = "#D0F5A9";
                                                                                                               break;
                                                                                                           case 5:
                                                                                                               $acquisition = "Maîtrisé";
                                                                                                               $couleurtd = "#A9F5A9";
                                                                                                               break;
                                                                                                       } 
                                                                                                           echo " <td style='font-weight:bold;background:$couleurtd; width: 300px;'> $valeur / 5 &nbsp; - &nbsp; $acquisition</td> ";
                                                                                                        }
                                                                                                        
                                                                                                       
                                                                                           }
                                                                                            
                                                                                }
                                                                               }
                                                                               echo "</tr>";
                                                                            }   
                                                                            }
                                                                            ?>   
                                                                      <?php echo ' </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>';             
                                                               }
                                                                            
                                                         }
                                                        
                                                    ?>
                                                
                                                        
                                            </div>
                                       </div>
                                    </ul>
                                    
                                    <?php
                                    //var_dump($resultnote);
                                    ?>
                                </div>                             
                            </div>                       
                    </div>
                </div>
            </div>
        </div>
                <!-- END PAGE TITLE -->
                <!-- BEGIN PAGE TOOLBAR -->

                <!-- END PAGE TOOLBAR -->
            
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <!-- BEGIN DASHBOARD STATS 1-->
            


@stop