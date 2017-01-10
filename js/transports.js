// var branch_sel = document.getElementById("branch_select");
// var lc_sel = document.getElementById("lc_select");
// var lcx_sel = document.getElementById("lcx_select");
//var zip_sel = document.getElementById("zip_select");

// var opts = lcx_sel.options;
//
// for(var opt, j = 0; opt = opts[j]; j++) {
//    console.log(j);
//    console.log(opt.value);
// }

  function reset13() {
     var branch_select = document.getElementById("branch_select");
     if (branch_select.selectedIndex !== 0) { branch_select.selectedIndex = 0; }
     var lcx_select = document.getElementById("lcx_select");
     if (lcx_select.selectedIndex !== 0) { lcx_select.selectedIndex = 0; }
  }

  function reset23() {
     var lc_select = document.getElementById("lc_select");
     if (lc_select.selectedIndex !== 0) { lc_select.selectedIndex = 0; }
     var lcx_select = document.getElementById("lcx_select");
     if (lcx_select.selectedIndex !== 0) { lcx_select.selectedIndex = 0; }
  }

  function reset12() {
     var branch_select = document.getElementById("branch_select");
     if (branch_select.selectedIndex !== 0) { branch_select.selectedIndex = 0; }
     var lc_select = document.getElementById("lc_select");
     if (lc_select.selectedIndex !== 0) { lc_select.selectedIndex = 0; }
  }

  function reset4() {
     var lc_selector = document.getElementById("lc_selector");
     if (lc_selector.selectedIndex !== 0) { lc_selector.selectedIndex = 0; }
  }

  function reset5() {
     var zip_select = document.getElementById("zip_select");
     if (zip_select.selectedIndex !== 0) { zip_select.selectedIndex = 0; }
  }
