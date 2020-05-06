<?php
  $json= json_decode(file_get_contents('../asset/Json/question.json'),true);
  $CText=0;
  $CSimple=0;
  $CMulti=0;
  for ($i=0; $i <count($json[$_SESSION['loginAdmin']]) ; $i++) { 
     if($json[$_SESSION['loginAdmin']][$i]["choix"]=="ChoixText")
     {
        $CText++;
     }
     elseif($json[$_SESSION['loginAdmin']][$i]["choix"]=="ChoixSimple")
     {
         $CSimple++;
     }
     else{
        $CMulti++;
     }
  }

  $score= json_decode(file_get_contents("../asset/Json/score.json"),true);
  arsort($score);
  $cpt=0;
  $i=1;
  $player=[];
  $scoring=[];
  foreach ($score as $key => $value) {
      $player[] =$key;
      $scoring[]=$value;
      $cpt++;
      if($cpt==5)
      {
      break;
      }
  }
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<div class="charts">
<canvas id="myChart1" style=" height: 52%; width: 100%; font-size: 1.5vw;"></canvas>
<canvas id="myChart2" style=" height: 45%; width: 100%; margin-top: 3%;"></canvas>
</div>
        <script>
              var ctx1 = document.getElementById("myChart1");
              var myChart1 = new Chart(ctx1, {
                  type: 'doughnut',
                  data: {
                      labels: ["Choix Multiple", "Choix Simple", "Choix Texte"],
                      datasets: [{
                            label: 'NOMBRE',
                            data: [<?php echo "$CMulti,$CSimple,$CText"; ?>],
                            backgroundColor:["#39ff14", "#86f6f7","#ff2281"],
                            borderColor: "#fff"
                                }]
                        },
                  options: {
                      title:{
                            text: "Représentation des types de Questions",
                            display: true,
                            color: "black"
                      }
                  }
              });

              var ctx2 = document.getElementById("myChart2");
              var myChart2 = new Chart(ctx2, {
                  type: 'bar',
                  data: {
                      labels: [<?php echo "'".$player[0]."','".$player[1]."','".$player[2]."','".$player[3]."','".$player[4]."'"; ?>],
                      datasets: [{
                            data: [<?php echo  "'".$scoring[0]."','".$scoring[1]."','".$scoring[2]."','".$scoring[3]."','".$scoring[4]."'"; ?>],
                            backgroundColor:["#962c5a","#555b6e","#39ff14", "#86f6f7","#ff2281"],
                            borderColor: "#fff"
                                }]
                        },
                  options: {
                      title:{
                            text: "Représentation des 5 meilleurs Score",
                            display: true
                      },
                      legend: {
                            display: false
                      }
                  }
              });
        </script>
