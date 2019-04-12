<html>
 <head>
  <meta charset="UTF-8">
  <title>Analyse Vergütungsstruktur</title>
  <link href="./lib/bootstrap.min.css" rel="stylesheet" />
  <link href="./css/style.css" rel="stylesheet" />
 </head>
 <body>
 <div class="container">
    <h1>Analyse Vergütungsstruktur</h1>
    <div id="generalInfos">
      <ul class="flex-container">
        <li class="flex-item">Stand Abrechnungszeitraum</li>
        <li class="flex-item">MM.JJJJ</li>
      </ul>
      <ul class="flex-container">
        <li class="flex-item">Ausgewertete Firma/Standorte:</li>
        <li class="flex-item">Aufzählung der ausgewählten Firma/Standorte</li>
      </ul>
      <ul class="flex-container">
        <li class="flex-item">Anzahl ausgewertete Mitarbeiter</li>
        <li class="flex-item">Wert aus Opti VU</li>
      </ul>
    </div>
    <div id="accordion">

      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
              Löhne und Gehälter
            </button>
          </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
            <table id="salaryTable" class="table table-stripped">
              <tr>
                <th>Gehälter</th>
                <th>Anzahl MA</th>
                <th>in %</th>
                <th>Stundenlöhne</th>
                <th>Anzahl MA</th>
                <th>in %</th>
              </tr>
            </table>
          </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse"
                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Monatliche brutto Zulagen und Zuschläge
            </button>
          </h5>
        </div>

    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <table id="benefitsTable" class="table table-stripped">
          <tr>
            <th></th>
            <th>Anzahl MA</th>
            <th>Niedrigster Betrag</th>
            <th>Höchster Betrag</th>
            <th>Durchschnittlicher Betrag</th>
          </tr>
        </table>
      </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse"
                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Stundenlöhne
            </button>
          </h5>
        </div>

    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <table id="hourlySalariesTable" class="table table-stripped">
          <tr>
            <th>Stundenlohn Kategorien</th>
            <th>Anzahl MA</th>
          </tr>
        </table>
      </div>
    </div>

    </div>

    <fieldset class="radio-group">
      <legend>Auswahl Diagramm</legend>
      <div>
        <input type="radio" id="salaries" name="diagramSelection" value="salaries"
              checked>
        <label for="salaries">Gehalt</label>
      </div>

      <div>
        <input type="radio" id="benefits" name="diagramSelection" value="benefits">
        <label for="benefits">Zulagen</label>
      </div>

      <div>
        <input type="radio" id="hourlySalaries" name="diagramSelection" value="hourly">
        <label for="hourlySalaries">Stundenlöhne</label>
      </div>
    </fieldset>
    
    <div id="chart">
      <canvas id="doughnutChart" width="800" height="450"></canvas>
    </div>
  </div>

 <?php 
    function transferCsvToArray($fileName) {
      $fh = fopen("./data/$fileName.csv", "r");
 
      $retArray = array();
    
      while (($row = fgetcsv($fh, 0, ",")) !== FALSE) {
          $retArray[] = $row;
      }

      return $retArray;
   }

   $salaries = transferCsvToArray("gehaelter");
   $salaryBenefits = transferCsvToArray("zulagen");
   $hourlySalaries = transferCsvToArray("stundenlohn");
  ?>
  <script>
    const ooData = {};  // "oo" is a namespace for to avoid collisions.

    ooData.salaries = <?php echo json_encode($salaries) ?>;
    ooData.salaryBenefits = <?php echo json_encode($salaryBenefits) ?>;
    ooData.hourlySalaries = <?php echo json_encode($hourlySalaries) ?>;
  </script>
  <script src="./lib/jquery.js"></script>
  <script src="./lib/bootstrap.min.js"></script>
  <script src="./lib/chartjs.js"></script>
  <script src="./js/utils.js"></script>
  <script src="./js/main.js"></script>
 </body>
</html>