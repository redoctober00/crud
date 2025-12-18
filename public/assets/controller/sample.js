var app = angular.module("WebApp", []);

app.controller("MainCtrl", [
  "$scope",
  "$http",
  function ($scope, $http) {


    $scope.getInfo = function () {
      $http.get(base_url + "sample").then(function (response) {
        $scope.records = response.data;
      });
    };

    $scope.editInfo = function ($id) {
      $http.get(base_url + "sample/show/" + $id).then(function (response) {
        $scope.form = response.data;
      });
    };

    $scope.saveInfo = function () {
      $http({
        method: "POST",
        url: base_url + "sample/create",
        data: $scope.data,
      }).then(function () {
        Swal.fire({
          icon: "success",
          title: "Saved!",
          text: "Record saved successfully.",
          timer: 1500,
          showConfirmButton: false,
        });
        $scope.data = {};
        $scope.getInfo();
      });
    };

    $scope.updateInfo = function (id) {
      $http({
        method: "POST",
        url: base_url + "sample/update/" + id,
        data: $scope.form,
      }).then(function () {
        Swal.fire({
          icon: "success",
          title: "Updated!",
          text: "Record updated successfully.",
          timer: 1500,
          showConfirmButton: false,
        });

        $scope.getInfo();

        var myModalEl = document.getElementById("edit-info");
        var modal = bootstrap.Modal.getInstance(myModalEl);
        modal.hide();
      });
    };

    $scope.deleteInfo = function (id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete",
      }).then((result) => {
        if (result.isConfirmed) {
          $http.get(base_url + "sample/delete/" + id).then(function () {
            Swal.fire({
              icon: "success",
              title: "Deleted!",
              text: "Record deleted successfully.",
              timer: 1500,
              showConfirmButton: false,
            });
            $scope.getInfo();
          });
        }
      });
    };
  },
]);

// Filters
app.filter("pagination", () => (input, start) => input?.slice(+start));

app.filter(
  "roundTo",
  (numberFilter) => (value, maxDecimals) =>
    numberFilter(
      (value || 0).toFixed(maxDecimals).replace(/(?:\.0+|(\.\d+?)0+)$/, "$1")
    )
);

app.filter("percentage", [
  "$filter",
  ($filter) => (input, decimals) => $filter("number")(input / 100, decimals),
]);

app.filter(
  "numbersWithoutTrailingZero",
  ($filter) => (input, decimalPlaces) =>
    input % 1
      ? $filter("number")(input, decimalPlaces)
      : $filter("number")(input, 0)
);

app.filter("numberEx", [
  "numberFilter",
  "$locale",
  (number, $locale) => {
    const formats = $locale.NUMBER_FORMATS;
    return (input, fractionSize) => {
      const formatted = number(input, fractionSize);
      const idx = formatted.indexOf(formats.DECIMAL_SEP);
      if (idx === -1) return formatted;
      const whole = formatted.substring(0, idx);
      const decimal = (Number(formatted.substring(idx)) || "").toString();
      return whole + decimal.substring(1);
    };
  },
]);

app.filter(
  "sumOfValue",
  () => (data, key) =>
    data?.reduce((sum, item) => sum + parseInt(item[key], 10), 0) || 0
);

app.filter(
  "capitalize",
  () => (input) =>
    angular.isString(input) && input.length > 0
      ? input.charAt(0).toUpperCase() + input.slice(1).toLowerCase()
      : input
);
