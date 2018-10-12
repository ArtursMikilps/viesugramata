<!doctype html>
<html ng-app="viesuApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Viesu Grāmata</title>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.4/angular.min.js"></script>
    <script type="text/javascript" src="{{asset('js/viesi.js')}}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">


</head>
<body ng-controller="viesiCtrl">
  <div class="entries"  >
      <button ng-click="orderByDate()" class="btn btn-light">
          Kārtot Pēc Datuma
      </button>
        <button ng-click="orderByName()" class="btn btn-light">
          Kārtot Pēc Lietotāja
      </button>
      <table style="margin: 0 auto;">
      <tr ng-repeat="viesis in viesi">
            <th><h3>"@{{viesis.teksts}}"</h3></th>
            <th><h3>-@{{viesis.lietotaja_vards}}</h3></th>
        </tr>

    </table>
    <div style="text-align: center;">
    <div>
    <button ng-click="previousPage()" class="btn btn-light">
      Iepriekšējā lapa
  </button>
  <button ng-click="nextPage()" class="btn btn-light">
      Nākošā lapa
  </button>
  <h3>@{{pageNumber+pageTotal}} </h3>
</div>
</div>
</div>
<h2 style="text-align: center;">Pievieno ierakstu!</h2>
<div class="form" style="width: 30%;margin: 0 auto;">
  <h1> @{{atbilde}}</h1>


  <form name="userForm" ng-submit="submitForm()" novalidate>
    <div class="form-group">
        <label>Lietotāja vārds</label>
        <input type="text" class="form-control" name="lietotaja_vards" ng-model="forma.lietotaja_vards" required>
        <span  ng-show="userForm.lietotaja_vards.$touched && userForm.lietotaja_vards.$invalid">Lietotāja vārds ir nepieciešams!</span>
   </div>
   <div class="form-group">
    <label>E-pasts</label>
    <input type="text" class="form-control" name="epasts" ng-model="forma.epasts" type="email" required>
    <span ng-show="userForm.epasts.$touched && userForm.epasts.$invalid">E-pasts ir nepieciešams!</span>
</div>
<div class="form-group">
    <label>Vietne</label>
    <input type="text" class="form-control" ng-model="forma.vietne" >

</div>
<div class="form-group" >
    <label>Ziņojuma Teksts</label>
   
        <textarea type="text" class="form-control" name="teksts" ng-model="forma.teksts" required cols="40" rows="5"></textarea>
        <span ng-show="userForm.teksts.$touched && userForm.teksts.$invalid">Ziņojuma teksts ir nepieciešams!</span>
</div>
<div class="g-recaptcha" data-sitekey="6LeGMXQUAAAAADxvEq7l0VYFJQod_mzQHvI7_QHb">
</div>
<h4> @{{captcha}}</h4>
<button type="submit" class="btn btn-primary" ng-disabled="userForm.$invalid">Submit</button>
</form>
</div>
</body>
</html>
