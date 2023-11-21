// =========================================================================================
//     File Name: invoice.js
//     Description: Invoice print js
//     --------------------------------------------------------------------------------------
//     Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
//     Author: Saad Raza
//     Author URL: http://www.themeforest.net/user/Saad Raza
// ==========================================================================================

$(document).ready(function () {
  // print invoice with button
  $(".btn-print").click(function () {
    window.print();
  });
});
